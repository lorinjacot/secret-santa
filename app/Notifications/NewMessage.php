<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessage extends Notification
{
    use Queueable;

    public $name;
    public $content;
    public $link;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $message,
    ) {
        if ($message->content === null) {
            $this->content = "![]($message->url)";
        } else {
            $this->content = $message->content;
        }
        $conv = $message->conversation;
        if ($message->sender_id === $conv->santa_id) {
            $this->link = route('conversation.santa');
            $this->name = "ton père Noël secret";
        } else {
            $this->link = route('conversation.target');
            $this->name = "ta cible";
        }
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
                    ->subject('Secret Santa - Nouveau message de '.$this->name)
                    ->markdown('mail.new-message', [
                        'name' => $this->name,
                        'content' => $this->content,
                        'link' => $this->link,
                    ]);
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
