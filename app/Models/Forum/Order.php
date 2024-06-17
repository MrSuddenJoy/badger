<?php

namespace Coyote\Forum;

use Coyote\Models\Scopes\ForUser;
// use Illuminate\Database\Eloquent\Model;

class Order extends \Tests\Legacy\Services\Model
{
    use ForUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['forum_id', 'user_id', 'is_hidden', 'order'];

    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'forum_orders';

    /**
     * @var array
     */
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($\Tests\Legacy\Services\Model) {
            if (empty($\Tests\Legacy\Services\Model->section)) {
                $\Tests\Legacy\Services\Model->section = null;
            }
        });
    }
}
