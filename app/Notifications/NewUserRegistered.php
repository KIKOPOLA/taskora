<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $newUser;

    /**
     * Create a new notification instance.
     */
    public function __construct($newUser)
    {
        $this->newUser = $newUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        // $notifiable is the admin user receiving the notification
        // We might want to pass data about the new user who registered
        return [
            'message' => 'New user registered: ' . $this->newUser->name,
            'user_id' => $this->newUser->id,
            'action_url' => route('users.index'),
        ];
    }
}
