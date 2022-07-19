<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VoteQuestionNotification extends Notification
{
    use Queueable;

    public $question, $voteValue, $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($question, $voteValue, $user)
    {
        $this->question = $question;
        $this->voteValue = $voteValue;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
        // return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        Log::info($notifiable);
        $user = $this->user;
        $question = $this->question;
        $vote = $this->voteValue == '1' ? 'liked' : 'dislike';

        return [
            "body" => __(
                ":name $vote your post (:title)",
                [
                    "name" => $user->name,
                    "title" => $question->title
                ]
            ),
            "url" => route('questions.show', $question->slug),
        ];
    }

    public function toBroadcast($notifiable)
    {
        $user = $this->user;
        $question = $this->question;
        $vote = $this->voteValue === 1 ? 'liked' : 'dislike';

        return [
            "body" => __(
                ":name $vote your post \n (:title)",
                [
                    "name" => $user->name,
                    "title" => $question->title
                ]
            ),
            "url" => route('questions.show', $question->slug),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
