<?php

namespace Coyote;

// use Illuminate\Database\Eloquent\Model;

class Word extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['word', 'replacement'];
    public $timestamps = false;
}
