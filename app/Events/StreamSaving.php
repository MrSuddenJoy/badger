<?php

namespace Coyote\Events;

use Coyote\Services\Stream\Activities\Activity;


class StreamSaving
{
    

    /**
     * @var Activity
     */
    public $activity;

    /**
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }
}
