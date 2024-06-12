<?php

namespace Coyote\Events;

use Coyote\Firewall;


class FirewallWasSaved
{
    

    /**
     * @var Firewall
     */
    protected $firewall;

    /**
     * Create a new event instance.
     *
     * @param Firewall $firewall
     */
    public function __construct(Firewall $firewall)
    {
        $this->firewall = $firewall;
    }
}
