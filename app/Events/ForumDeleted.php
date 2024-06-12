<?php

namespace Coyote\Events;


use Coyote\Forum;

class ForumDeleted
{
    

    /**
     * @var array
     */
    public $forum;

    /**
     * Create a new event instance.
     *
     * @param Forum $forum
     */
    public function __construct(Forum $forum)
    {
        $this->forum = $forum->toArray();
    }
}
