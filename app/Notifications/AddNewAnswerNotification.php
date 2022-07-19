<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddNewAnswerNotification extends Notification
{
    use Queueable;

    public $question, $answer, $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($question, $answer, $user)
    {
        $this->question = $question;
        $this->answer = $answer;
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
    }

    public function toDatabase($notifiable)
    {
        return $this->toArray($notifiable);
    }

    public function toBroadcast($notifiable)
    {
        return $this->toArray($notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = $this->user;
        $question = $this->question;
        $answer = $this->answer;

        return [
            "body" => __(
                ":name answered (:answer) to your post \n (:title)",
                [
                    "name" => $user->name,
                    "answer" => $answer->content,
                    "title" => $question->title
                ]
            ),
            "url" => route('questions.show', $question->slug),
        ];
    }
}
