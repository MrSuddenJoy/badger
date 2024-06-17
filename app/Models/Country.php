<?php

namespace Coyote;

// use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $code
 * @property float $vat_rate
 */
class Country extends \Tests\Legacy\Services\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
