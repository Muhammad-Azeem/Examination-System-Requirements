<?php

namespace App\Notifications;

use App\Models\UserAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCompletedPaper extends Notification implements ShouldQueue
{
    use Queueable;

    protected $userAttempt;

    public function __construct(UserAttempt $userAttempt)
    {
        $this->userAttempt = $userAttempt;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A user has completed a paper.')
            ->action('Review Attempt', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'user_attempt_id' => $this->userAttempt->id,
            'message' => 'A user has completed a paper.',
        ];
    }
}
