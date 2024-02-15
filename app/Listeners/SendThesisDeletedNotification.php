<?php

namespace App\Listeners;

use App\Notifications\ThesisDeletedParticipantNotification;

class SendThesisDeletedNotification
{
    public function handle(object $event): void
    {
        $partcicpantUser = $event->thesis->participation->participant->user;

        $partcicpantUser->notify(new ThesisDeletedParticipantNotification($event->thesis));
    }
}
