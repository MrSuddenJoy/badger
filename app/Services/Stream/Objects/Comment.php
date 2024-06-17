<?php

namespace Coyote\Services\Stream\Objects;

use Coyote\Services\UrlBuilder;

class Comment extends ObjectAbstract
{
    private const EXCERPT_SIZE = 1024;

    /**
     * @param mixed ...$args
     * @return $this
     * @throws \Exception
     */
    public function map(...$args)
    {
        $class = class_basename($args[0]);
        if (!method_exists($this, $class)) {
            throw new \Exception("There is not method called $class");
        }
        $this->$class(...$args);
        return $this;
    }

    public function comment(\Coyote\Comment $comment)
    {
        $this->id = $comment->id;
        $this->displayName = excerpt($comment->html, self::EXCERPT_SIZE);
        $this->url = UrlBuilder::url($comment->resource) . '#comment-' . $comment->id;

        return $this;
    }
}
