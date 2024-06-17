<?php

namespace Coyote\Notification;

// use Illuminate\Database\Eloquent\Model;

class Type extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'notification_types';

    /**
     * @var bool
     */
    public $timestamps = false;
}
