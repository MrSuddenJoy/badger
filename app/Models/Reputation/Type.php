<?php

namespace Coyote\Reputation;

// use Illuminate\Database\Eloquent\Model;

class Type extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'reputation_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'points'];
    public $timestamps = false;
}
