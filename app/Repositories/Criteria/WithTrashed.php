<?php

namespace Coyote\Repositories\Criteria;

use Coyote\Repositories\Contracts\RepositoryInterface as Repository;

class WithTrashed extends Criteria
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @param Repository $repository
     * @return \Illuminate\Database\Eloquent\Builder
     * @todo #29 Merge it with other files. Think of container of sorts for return-only functions
     */
    public function apply($model, Repository $repository)
    {
        return $model->withTrashed();
    }
}
