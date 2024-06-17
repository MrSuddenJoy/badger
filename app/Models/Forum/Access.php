<?php

namespace Coyote\Forum;

use Coyote\Group;
// use Illuminate\Database\Eloquent\Model;

class Access extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['forum_id', 'group_id'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'forum_access';

    /**
     * @var array
     */
    public $timestamps = false;

    /**
     * The primary key for the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $primaryKey = 'group_id';

    /**
     * @var bool
     */
    public $incrementing = false;
}
