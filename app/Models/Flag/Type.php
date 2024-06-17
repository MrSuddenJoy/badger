<?php

namespace Coyote\Flag;

// use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 */
class Type extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'flag_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'order'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
