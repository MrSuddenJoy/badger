<?php

namespace Coyote\Http\Controllers\Guide;

use Coyote\Events\GuideSaved;
use Coyote\Http\Controllers\Controller;
use Coyote\Http\Requests\GuideRequest;
use Coyote\Http\Resources\GuideResource;
use Coyote\Guide;

class SubmitController extends Controller
{
    public function form()
    {
        return $this->view('guide.form');
    }

    public function save(Guide $guide, GuideRequest $request)
    {
        if (!$guide->exists) {
            $guide->user()->associate($this->auth);
        } else {
            $this->authorize('update', $guide);
        }

        $guide->fill($request->all());

        $this->transaction(function () use ($guide, $request) {
            $guide->save();

            $guide->setTags(array_pluck($request->input('tags', []), 'name'));
        });

        event(new GuideSaved($guide));

        GuideResource::withoutWrapping();

        return new GuideResource($guide);

    }
}
