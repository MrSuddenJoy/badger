<?php

namespace Coyote\Events;

use Coyote\Job;


class JobDeleted
{
    

    /**
     * @var array
     */
    public $job;

    /**
     * Create a new event instance.
     *
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
