<?php

namespace Coyote\Policies;

use Coyote\Pm;
use Coyote\User;


class PmPolicy
{
    // Think of sth that can be used here (in `use` directive)

    /**
     * @param User $user
     * @param Pm $pm
     * @return bool
     */
    public function show(User $user, Pm $pm)
    {
        return $user->id === $pm->user_id;
    }
}
