<?php

namespace Coyote\Events;



class UserSaved
{
    

    public $user;

    /**
     * Create a new event instance.
     *
     * @param \Coyote\User $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
