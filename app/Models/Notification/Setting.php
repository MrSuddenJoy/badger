<?php

namespace Coyote\Notification;

// use Illuminate\Database\Eloquent\Model;

class Setting extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'notification_settings';

    /**
     * @var bool
     */
    public $timestamps = false;
}
