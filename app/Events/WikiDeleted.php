<?php

namespace Coyote\Events;


use Coyote\Wiki;

class WikiDeleted
{
    

    /**
     * @var array
     */
    public $wiki;

    /**
     * @param Wiki $wiki
     */
    public function __construct(Wiki $wiki)
    {
        $this->wiki = $wiki->toArray();
    }
}
