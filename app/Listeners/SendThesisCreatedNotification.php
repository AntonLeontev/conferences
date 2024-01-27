<?php

namespace App\Listeners;

use App\Events\ThesisCreated;
use App\Notifications\ThesisCreatedOrganizationNotification;
use App\Notifications\ThesisCreatedParticipantNotification;

class SendThesisCreatedNotification
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
    public function handle(ThesisCreated $event): void
    {
        $partcicpantUser = $event->thesis->participation->participant->user;
        $organizationUser = $event->thesis->participation->conference->organization->user;

        $organizationUser->notify(new ThesisCreatedOrganizationNotification($event->thesis));
        $partcicpantUser->notify(new ThesisCreatedParticipantNotification($event->thesis));
    }
}
