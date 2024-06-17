<?php

namespace Coyote\Job;

// use Illuminate\Database\Eloquent\Model;

class Feature extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id', 'feature_id', 'value', 'is_checked'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'job_features';

    /**
     * @var array
     */
    public $timestamps = false;
}
