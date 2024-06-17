<?php

namespace Coyote\Wiki;

// use Illuminate\Database\Eloquent\Model;

class Redirect extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'wiki_redirects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path', 'path_id'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
