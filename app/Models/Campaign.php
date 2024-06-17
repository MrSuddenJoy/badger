<?php

namespace Coyote;

// use Illuminate\Database\Eloquent\Model;

class Campaign extends \Tests\Legacy\Services\Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
}
