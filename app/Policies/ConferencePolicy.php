<?php

namespace App\Policies;

use Src\Domains\Auth\Models\User;
use Src\Domains\Conferences\Models\Conference;

class ConferencePolicy
{
    public function create(User $user): bool
    {
        return ! is_null($user->organization);
    }

    public function update(User $user, Conference $conference): bool
    {
        return $conference->organization_id === $user->organization->id;
    }

    public function viewAbstracts(User $user, Conference $conference): bool
    {
        return $conference->organization_id === $user->organization->id;
    }

    public function viewParticipations(User $user, Conference $conference): bool
    {
        return $conference->organization_id === $user->organization->id;
    }
}
