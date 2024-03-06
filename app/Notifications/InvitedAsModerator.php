<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Src\Domains\Conferences\Models\Conference;
use Src\Domains\Conferences\Models\Section;

class InvitedAsModerator extends Notification implements ShouldQueue
{
    use Queueable;

    public Conference $conference;

    public function __construct(public Model $moderable)
    {
        $this->conference = match (true) {
            $moderable instanceof Conference => $moderable,
            $moderable instanceof Section => $moderable->conference,
        };
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
        return (new MailMessage)
            ->line("Вас прегласили быть модератором на мероприятии '{$this->conference->title_ru}'.")
            ->action('Перейти к мероприятию', route('conference.show', $this->conference->slug));
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
