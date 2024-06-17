<?php

namespace Coyote\Topic;

// use Illuminate\Database\Eloquent\Model;

class Tag extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['topic_id', 'tag_id'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'topic_tags';

    /**
     * @var array
     */
    public $timestamps = false;
}
