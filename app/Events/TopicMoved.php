<?php

namespace Coyote\Events;

use Coyote\Topic;


class TopicMoved
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
