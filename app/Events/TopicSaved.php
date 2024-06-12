<?php

namespace Coyote\Events;

use Coyote\Topic;


class TopicSaved
{
    

    /**
     * @var Topic
     */
    public $topic;

    /**
     * Create a new event instance.
     *
     * @param Topic $topic
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }
}
