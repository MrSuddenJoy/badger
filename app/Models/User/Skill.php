<?php

namespace Coyote\User;

// use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property int $rate
 * @property int $order
 */
class Skill extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'rate', 'order'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'user_skills';

    /**
     * @var bool
     */
    public $timestamps = false;
}
