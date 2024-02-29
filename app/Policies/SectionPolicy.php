<?php

namespace App\Policies;

use Src\Domains\Auth\Models\User;
use Src\Domains\Conferences\Models\Section;

class SectionPolicy
{
    public function delete(User $user, Section $section): bool
    {
        return $section->conference->organization_id === $user->organization->id;
    }
}
