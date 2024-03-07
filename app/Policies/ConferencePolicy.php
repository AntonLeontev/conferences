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
        return $conference->organization_id === $user->organization?->id;
    }

    public function viewAbstracts(User $user, Conference $conference): bool
    {
        // Если создатель конференции
        if ($conference->organization_id === $user->organization?->id) {
            return true;
        }

        //Если модератор секции
        $moderable = $user->moderatedSections
            ->first(fn ($section) => $section->conference_id === $conference->id);

        if (! is_null($moderable)) {
            return true;
        }

        //Если модератор конференции
        $moderable = $user->moderatedConferences
            ->first(fn ($conf) => $conf->id === $conference->id);

        if (! is_null($moderable)) {
            return true;
        }

        return false;
    }

    public function viewParticipations(User $user, Conference $conference): bool
    {
        // Если создатель конференции
        if ($conference->organization_id === $user->organization?->id) {
            return true;
        }

        //Если модератор секции
        $moderable = $user->moderatedSections
            ->first(fn ($section) => $section->conference_id === $conference->id);

        if (! is_null($moderable)) {
            return true;
        }

        //Если модератор конференции
        $moderable = $user->moderatedConferences
            ->first(fn ($conf) => $conf->id === $conference->id);

        if (! is_null($moderable)) {
            return true;
        }

        return false;
    }

    public function massSectionUpdate(User $user, Conference $conference): bool
    {
        return $conference->organization_id === $user->organization?->id;
    }
}
