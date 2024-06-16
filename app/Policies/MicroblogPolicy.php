<?php

namespace Coyote\Policies;

use Coyote\Microblog;
use Coyote\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MicroblogPolicy
{
    // Think of sth that can be used here (in `use` directive)

    /**
     * @param User $user
     * @param Microblog $microblog
     * @return bool
     */
    public function update(User $user, Microblog $microblog): bool
    {
        return $user->id === $microblog->user_id || $user->can('microblog-update');
    }

    /**
     * @param User $user
     * @param Microblog $microblog
     * @return bool
     */
    public function delete(User $user, Microblog $microblog): bool
    {
        return $user->id === $microblog->user_id || $user->can('microblog-delete');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function moderate(User $user): bool
    {
        return $user->can('microblog-update');
    }
}
