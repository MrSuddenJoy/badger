<?php

namespace Coyote\Policies;

use Coyote\Job;
use Coyote\User;


class JobPolicy
{
    // Think of sth that can be used here (in `use` directive)

    /**
     * @param User $user
     * @param Job $job
     * @return bool
     */
    public function update(User $user, Job $job)
    {
        return $user->id === $job->user_id || $user->can('job-update');
    }

    /**
     * @param User $user
     * @param Job $job
     * @return bool
     */
    public function delete(User $user, Job $job)
    {
        return $user->id === $job->user_id || $user->can('job-delete');
    }
}
