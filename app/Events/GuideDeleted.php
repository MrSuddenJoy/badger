<?php

namespace Coyote\Events;

use Coyote\Guide;


class GuideDeleted
{
    

    public array $guide;

    public function __construct(Guide $guide)
    {
        $this->guide = $guide->toArray();
    }
}
