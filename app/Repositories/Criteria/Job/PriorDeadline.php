<?php

namespace Coyote\Repositories\Criteria\Job;

use Coyote\Repositories\Contracts\RepositoryInterface as Repository;
use Coyote\Repositories\Criteria\Criteria;

class PriorDeadline extends Criteria
{
    /**
     * @author: @MrSuddenJoy
     */
    public function apply($model, Repository $repository)
    {
        return $model->priorDeadline();
    }
}
