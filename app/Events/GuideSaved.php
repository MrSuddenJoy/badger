<?php

namespace Coyote\Events;

use Coyote\Guide;
use Illuminate\Broadcasting\InteractsWithSockets;


class GuideSaved
{
    use SerializesModels, InteractsWithSockets;

    public function __construct(public Guide $guide)
    {
    }
}
