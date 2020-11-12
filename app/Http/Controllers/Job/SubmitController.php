<?php

namespace Coyote\Http\Controllers\Job;

use Coyote\Currency;
use Coyote\Events\JobWasSaved;
use Coyote\Firm;
use Coyote\Firm\Benefit;
use Coyote\Http\Requests\Job\JobRequest;
use Coyote\Http\Resources\FirmFormResource as FirmResource;
use Coyote\Http\Resources\JobFormResource;
use Coyote\Job;
use Coyote\Http\Controllers\Controller;
use Coyote\Notifications\Job\CreatedNotification;
use Coyote\Repositories\Contracts\FirmRepositoryInterface as FirmRepository;
use Coyote\Repositories\Contracts\JobRepositoryInterface as JobRepository;
use Coyote\Repositories\Contracts\PlanRepositoryInterface as PlanRepository;
use Coyote\Repositories\Criteria\EagerLoading;
use Coyote\Services\Job\SubmitsJob;
use Coyote\Services\Stream\Activities\Create as Stream_Create;
use Coyote\Services\Stream\Activities\Update as Stream_Update;
use Coyote\Services\Stream\Objects\Job as Stream_Job;
use Coyote\Services\UrlBuilder;
use Coyote\Tag;

class SubmitController extends Controller
{
    use SubmitsJob;

    /**
     * @param JobRepository $job
     * @param FirmRepository $firm
     * @param PlanRepository $plan
     */
    public function __construct(JobRepository $job, FirmRepository $firm, PlanRepository $plan)
    {
        parent::__construct();

        $this->job = $job;
        $this->firm = $firm;
        $this->plan = $plan;
    }

    /**
     * @param Job $job
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Job $job)
    {
        if (!$job->exists) {
            $job = $this->loadDefaults($job, $this->auth);
        }

        if (!count($job->locations)) {
            $job->locations->add(new Job\Location());
        }

        $this->authorize('update', $job);

        $this->breadcrumb($job);

        // get all firms assigned to user...
        $this->firm->pushCriteria(new EagerLoading(['benefits', 'gallery']));

        $firms = FirmResource::collection($this->firm->findAllBy('user_id', $this->userId));

        return $this->view('job.submit.home', [
            'popular_tags'      => $this->job->getPopularTags(),
            'job'               => new JobFormResource($job),
            'firms'             => $firms,

            // is plan is still going on?
            'is_plan_ongoing'   => $job->is_publish,
            'plans'             => $this->plan->active()->toJson(),
            'currencies'        => Currency::all(),
            'default_benefits'  => Benefit::getBenefitsList(), // default benefits,
            'employees'         => Firm::getEmployeesList(),
        ]);
    }

    /**
     * @param JobRequest $request
     * @param Job $job
     * @return string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function save(JobRequest $request, Job $job)
    {
        $job->fill($request->all());

        if ($request->has('firm.name')) {
            $job->firm->fill($request->input('firm'));

            // firm ID is present. user is changing assigned firm
            if ($request->filled('firm.id')) {
                $job->firm->id = $request->input('firm.id');
                $job->firm->exists = true;

                // syncOriginalAttribute() is important if user changes firm
                $job->firm->syncOriginalAttribute('id');
            } else {
                $job->firm->exists = false;

                unset($job->firm->id);
            }

            Firm::creating(function (Firm $model) {
                $model->user_id = $this->userId;
            });
        } else {
            $job->firm()->dissociate();
        }

        $this->transaction(function () use ($job, $request) {
            $activity = $job->id ? Stream_Update::class : Stream_Create::class;

            if ($job->firm) {
                // fist, we need to save firm because firm might not exist.
                $job->firm->save();

                // reassociate job with firm. user could change firm, that's why we have to do it again.
                $job->firm()->associate($job->firm);
                // remove old benefits and save new ones.
                $job->firm->benefits()->push($job->firm->benefits);
                $job->firm->gallery()->push($job->firm->gallery);
            }

            $job->creating(function (Job $model) {
                $model->user_id = $this->userId;
            });

            $job->save();
            $job->locations()->push($job->locations);

            $job->tags()->sync($this->tags($request));
            $job->features()->sync($this->features($request));

            stream($activity, (new Stream_Job)->map($job));

            if ($job->wasRecentlyCreated || !$job->is_publish) {
                $job->payments()->create(['plan_id' => $job->plan_id, 'days' => $job->plan->length]);
            }

            event(new JobWasSaved($job)); // we don't queue listeners for this event
        });

        if ($job->wasRecentlyCreated) {
            $job->user->notify(new CreatedNotification($job));
        }

        if ($unpaidPayment = $this->getUnpaidPayment($job)) {
            session()->flash('success', 'Oferta została dodana, lecz nie jest jeszcze promowana. Uzupełnij poniższy formularz, aby zakończyć.');

            return route('job.payment', [$unpaidPayment]);
        }

        session()->flash('success', 'Oferta została prawidłowo dodana.');

        return UrlBuilder::job($job);
    }

    /**
     * @param $job
     */
    private function breadcrumb($job)
    {
        $this->breadcrumb->push('Praca', route('job.home'));

        if (empty($job['id'])) {
            $this->breadcrumb->push('Wystaw ofertę pracy', route('job.submit'));
        } else {
            $this->breadcrumb->push($job['title'], route('job.offer', [$job['id'], $job['slug']]));
            $this->breadcrumb->push('Edycja oferty', route('job.submit'));
        }
    }

    private function features(JobRequest $request): array
    {
        $features = [];

        foreach ($request->input('features', []) as $feature) {
            $checked = (int) $feature['checked'];

            $features[$feature['id']] = ['checked' => $feature['checked'], 'value' => $checked ? ($feature['value'] ?? null) : null];
        }

        return $features;
    }

    private function tags(JobRequest $request): array
    {
        $tags = [];
        $order = 0;

        foreach ($request->input('tags', []) as $tag) {
            $model = Tag::firstOrCreate(['name' => $tag['name']]);

            $tags[$model->id] = [
                'priority'  => $tag['priority'] ?? 0,
                'order'     => ++$order
            ];
        }

        return $tags;
    }
}
