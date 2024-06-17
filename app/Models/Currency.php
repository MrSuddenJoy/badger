<?php

namespace Coyote;

// use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $symbol
 */
class Currency extends \Tests\Legacy\Services\Model
{
    const PLN = 1;
    const EUR = 2;
    const USD = 3;
    const GBP = 4;
    const CHF = 5;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return null
     */
    public function exchanges()
    {
        return $this->hasMany(Exchange::class);
    }
}
