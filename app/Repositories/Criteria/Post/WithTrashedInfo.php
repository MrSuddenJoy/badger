<?php

namespace Coyote\Repositories\Criteria\Post;

use Coyote\Repositories\Contracts\RepositoryInterface as Repository;
use Coyote\Repositories\Criteria\Criteria;

class WithTrashedInfo extends Criteria
{
    /**
     * @author: @MrSuddenJoy
     */
    public function apply($model, Repository $repository)
    {
        return $model->addSelect('deleter.name AS deleter_name')->leftJoin('users AS deleter', 'deleter.id', '=', 'deleter_id');
    }
}
