<?php

namespace Coyote\Events;

use Coyote\Wiki;


class WikiSaved
{
    

    /**
     * @var Wiki
     */
    public $wiki;

    /**
     * @var string
     */
    public $host;

    /**
     * @param Wiki $wiki
     */
    public function __construct(Wiki $wiki)
    {
        $this->wiki = $wiki;
        $this->host = request()->getHost();
    }
}
