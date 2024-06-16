<?php

namespace Coyote\Policies;

use Coyote\Firm;
use Coyote\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FirmPolicy
{
    // Think of sth that can be used here (in `use` directive)

    /**
     * @param User $user
     * @param Firm $firm
     * @return bool
     */
    public function update(User $user, Firm $firm)
    {
        return $user->id === $firm->user_id || $user->can('firm-update');
    }

    /**
     * @param User $user
     * @param Firm $firm
     * @return bool
     */
    public function delete(User $user, Firm $firm)
    {
        return $user->id === $firm->user_id || $user->can('firm-delete');
    }
}
