<?php

namespace Coyote\Firm;

// use Illuminate\Database\Eloquent\Model;

/**
 * @deprecated
 * @property string $file
 * @property string $url
 */
class Gallery extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'firm_gallery';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firm_id', 'file'];

    /**
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:se';
}
