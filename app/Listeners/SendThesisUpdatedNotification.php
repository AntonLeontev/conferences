<?php

namespace App\Listeners;

use App\Events\ThesisUpdated;
use App\Notifications\ThesisUpdatedNotification;
use Src\Domains\Conferences\Models\Section;

class SendThesisUpdatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ThesisUpdated $event): void
    {
        $thesis = $event->thesis;
        $conference = $thesis->participation->conference;

        $organizationUser = $conference->organization->user;

        $organizationUser->notify(new ThesisUpdatedNotification($thesis));

        foreach ($conference->moderators as $moderator) {
            $moderator->notify(new ThesisUpdatedNotification($thesis));
        }

        if (! is_null($thesis->section_id)) {
            $section = Section::find($thesis->section_id);

            foreach ($section->moderators as $moderator) {
                $moderator->notify(new ThesisUpdatedNotification($thesis));
            }
        }
    }
}
