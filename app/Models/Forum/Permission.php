<?php

namespace Coyote\Forum;

// use Illuminate\Database\Eloquent\Model;

class Permission extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['forum_id', 'group_id', 'permission_id', 'value'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'forum_permissions';

    /**
     * @var array
     */
    public $timestamps = false;
}
