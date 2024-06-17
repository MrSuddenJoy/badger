<?php

namespace Coyote\Page;

// use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $page_id
 * @property string $date
 * @property int $visits
 */
class Stat extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['page_id', 'date', 'visits'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'page_stats';

    /**
     * @var bool
     */
    public $timestamps = false;
}
