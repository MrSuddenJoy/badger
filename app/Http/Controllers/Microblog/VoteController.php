<?php
namespace Coyote\Http\Controllers\Microblog;

use Coyote\Events\MicroblogVoted;
use Coyote\Http\Controllers\Controller;
use Coyote\Http\Resources\MicroblogResource;
use Coyote\Microblog;
use Coyote\Notifications\Microblog\VotedNotification;
use Coyote\Reputation;
use Coyote\Services\Stream\Activities\Vote as Stream_Vote;
use Coyote\Services\Stream\Objects\Comment as Stream_Comment;
use Coyote\Services\Stream\Objects\Microblog as Stream_Microblog;
use Coyote\Services\UrlBuilder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        MicroblogResource::withoutWrapping();
    }

    /**
     * @param Microblog $microblog
     * @param Request $request
     * @return array
     * @throws AuthenticationException
     * @throws AuthorizationException
     */
    public function post(Microblog $microblog, Request $request)
    {
        if (auth()->guest()) {
            throw new AuthenticationException('Musisz być zalogowany, aby oddać ten głos.');
        }

        if (!$this->auth->is_confirm) {
            throw new AuthorizationException('Nie możesz oddać głosu na ten wpis ponieważ nie potwierdziłeś adresu e-mail. <a href="/Confirm">Kliknij, aby zrobić to teraz.</a>.');
        }

        // throw error if parent entry was removed
        abort_if($microblog->parent_id && !$microblog->parent, 404);

        /** @var \Coyote\Microblog\Vote $vote */
        $vote = $microblog->voters()->forUser($this->userId)->first();

        if (!config('app.debug')) {
            if ($this->userId === $microblog->user_id) {
                throw new AuthorizationException('Nie możesz głosować na wpisy swojego autorstwa.');
            }
            if ($this->auth->reputation < Reputation::VOTE) {
                throw new AuthorizationException('Nie możesz jeszcze oddawać głosów na wpisy innych.');
            }
        }

        $vote = $this->transaction(function () use ($vote, $microblog, $request) {
            if ($vote) {
                $vote->delete();

                $microblog->votes--;
            } else {
                $vote = $microblog->voters()->create(['user_id' => $this->userId, 'ip' => $request->ip()]);
                $microblog->votes++;
            }

            $microblog->resetScore();
            $target = null;

            // reputacje przypisujemy tylko za ocene wpisu a nie komentarza!!
            if (!$microblog->parent_id) {
                $url = UrlBuilder::microblog($microblog);
                $object = (new Stream_Microblog())->map($microblog);

                app('reputation.microblog.vote')->map($microblog)->setUrl($url)->setPositive($vote->wasRecentlyCreated)->save();
            } else {
                $object = (new Stream_Comment())->map($microblog);
                $target = (new Stream_Microblog())->map($microblog->parent);
            }

            $microblog->save();

            // put this to activity stream
            stream(Stream_Vote::class, $object, $target);

            return $vote;
        });

        if ($vote->wasRecentlyCreated && $microblog->user) {
            $microblog->user->notify(new VotedNotification($vote));
        }

        $payload = $this->voters($microblog);

        broadcast(new MicroblogVoted($payload))->toOthers();

        return $payload;
    }

    public function voters(Microblog $microblog)
    {
        $microblog->load(['voters', 'voters.user' => fn($query) => $query->select('id', 'name')->withTrashed()]);

        return ['id' => $microblog->id, 'parent_id' => $microblog->parent_id, 'users' => $microblog->voters->pluck('user.name')];
    }
}
