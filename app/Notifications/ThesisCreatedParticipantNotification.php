<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Src\Domains\Conferences\Models\Thesis;

class ThesisCreatedParticipantNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Thesis $thesis)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $conference = $this->thesis->load('participation')->participation->conference;
        $locale = $conference->abstracts_lang->value;

        return (new MailMessage)
            ->subject(__('emails/notifications.thesis_created_participant_notification.subject'))
            ->line(__(
                'emails/notifications.thesis_created_participant_notification.title',
                ['conference' => $conference->{'title_'.$locale}],
            ))
            ->action(
                __('emails/notifications.thesis_created_participant_notification.action'),
                route('conference.show', $conference->slug)
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
