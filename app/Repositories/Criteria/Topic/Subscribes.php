<?php

namespace Coyote\Repositories\Criteria\Topic;

use Coyote\Repositories\Contracts\RepositoryInterface as Repository;
use Coyote\Repositories\Criteria\Criteria;
use Coyote\Topic;
use Illuminate\Database\Query\Builder;

class Subscribes extends Criteria
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @author: @MrSuddenJoy
     */
    public function apply($model, Repository $repository)
    {
        return $model->whereExists(function (Builder $builder) {
            return $builder
                ->select('id')
                ->from('subscriptions')
                ->whereRaw('resource_id = topics.id')
                ->where('resource_type', Topic::class)
                ->where('user_id', $this->userId);
        });
    }
}
