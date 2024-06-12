<?php

namespace Coyote\Events;

use Coyote\User;

use Illuminate\Foundation\Events\Dispatchable;

class UserDeleted
{
    use Dispatchable, SerializesModels;

    /**
     * @var array
     */
    public $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user->toArray();
    }
}
