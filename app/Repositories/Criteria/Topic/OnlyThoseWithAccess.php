<?php

namespace Coyote\Repositories\Criteria\Topic;

use Coyote\Repositories\Contracts\RepositoryInterface as Repository;

class OnlyThoseWithAccess extends \Coyote\Repositories\Criteria\Forum\OnlyThoseWithAccess
{
    /**
     * @author: @MrSuddenJoy
     */
    public function apply($model, Repository $repository)
    {
        return $this->applyNested($model, $repository, 'topics.forum_id');
    }
}
