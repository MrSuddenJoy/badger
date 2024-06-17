<?php

namespace Coyote;

// use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $expires
 * @property string $text
 * @property string $title
 * @property string $mode
 */
class Pastebin extends \Tests\Legacy\Services\Model
{
    /**
     * @var string
     */
    protected $table = 'pastebin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'text', 'expires', 'title', 'mode'];

    /**
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:se';

    /**
     * @var array
     */
    protected $casts = ['created_at' => 'datetime'];

    /**
     * @var bool
     */
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($\Tests\Legacy\Services\Model) {
            /** @var \Coyote\Pastebin $\Tests\Legacy\Services\Model */
            if (empty($\Tests\Legacy\Services\Model->expires)) {
                $\Tests\Legacy\Services\Model->expires = null;
            }
        });
    }
}
