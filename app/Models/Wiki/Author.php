<?php

namespace Coyote\Wiki;

// use Illuminate\Database\Eloquent\Model;

class Author extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'wiki_authors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['wiki_id', 'user_id', 'share', 'length'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
