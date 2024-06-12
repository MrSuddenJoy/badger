<?php

namespace Coyote\Events;

use Coyote\Post;


class PostWasDeleted
{
    

    /**
     * @var array
     */
    public $post;

    /**
     * Create a new event instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = array_only($post->toArray(), ['id']);
    }
}
