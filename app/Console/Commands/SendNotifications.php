<?php

namespace App\Console\Commands;

use App\Mail\NotificationMail;
use App\Models\Conversation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'conversations:send-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie les notifications aux abonnés';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->withProgressBar(Conversation::all(), function (Conversation $conversation) {
            $unread_messages = $conversation->messages()->where('read', false)->get();
            $conversation->subscriptions()->each(function ($subscription) use ($unread_messages) {
                $route_name = $subscription->is_giver ? 'show_giver' : 'show_receiver';
                $url = route($route_name, $subscription->conversation_id);
                $messages = $unread_messages->filter(function ($message) use ($subscription) {
                    return $message->is_giver !== $subscription->is_giver;
                });
                Mail::to($subscription->email)->send(new NotificationMail($url, $messages));
            });
        });

        return Command::SUCCESS;
    }
}
