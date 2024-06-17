<?php

namespace Coyote\Firm;

class Industry extends \Tests\Legacy\Services\Model
{
    /**
     * The database table used by the \Tests\Legacy\Services\Model.
     *
     * @var string
     */
    protected $table = 'firm_industries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firm_id', 'industry_id'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
