<?php

namespace Coyote\Job;

// use Illuminate\Database\Eloquent\Model;

class Tag extends \Tests\Legacy\Services\Model
{
    const MUST_HAVE = 1;
    const NICE_TO_HAVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id', 'tag_id', 'priority', 'order'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'job_tags';

    /**
     * @var array
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tag()
    {
        return $this->hasOne('Coyote\Tag');
    }
}
