<?php

namespace App\Policies;

use Src\Domains\Auth\Models\User;
use Src\Domains\Conferences\Models\Thesis;

class ThesisPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ! is_null($user->participant);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Thesis $thesis): bool
    {
        return $user->participant->id === $thesis->participation->participant_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Thesis $thesis): bool
    {
        return $user->participant->id === $thesis->participation->participant_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Thesis $thesis): bool
    {
        return $user->participant->id === $thesis->participation->participant_id;
    }
}
