<?php
namespace Coyote\Events;

class CommentDeleted
{
    /**
     * @var array
     */
    public $comment_arr = array();

    /**
     *
     */
    public function __construct(public $comment)
    {
        //$this->comment = array_only($comment->toArray(), ['id']);
        $this->comment = array_splice($this->comment_arr, 'id', null, null);
    }
}
