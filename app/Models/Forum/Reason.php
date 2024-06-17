<?php

namespace Coyote\Forum;

// use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 */
class Reason extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'forum_reasons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
