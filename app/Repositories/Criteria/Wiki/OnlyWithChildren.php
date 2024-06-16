<?php

namespace Coyote\Repositories\Criteria\Wiki;

use Coyote\Repositories\Contracts\RepositoryInterface as Repository;
use Coyote\Repositories\Criteria\Criteria;

class OnlyWithChildren extends Criteria
{
    /**
     * @author: @MrSuddenJoy
     */
    public function apply($model, Repository $repository)
    {
        return $model->where('children', '>', 0);
    }
}
