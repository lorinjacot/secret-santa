<?php

namespace App\Http\Livewire\Conversations;

use App\Models\Conversation;
use Livewire\Component;

class SubscriptionForm extends Component
{
    public string $email = '';
    public bool $is_giver;
    public Conversation $conversation;

    public function render()
    {
        return view('livewire.conversations.subscription-form');
    }

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $this->conversation->subscriptions()->create([
            'email' => $this->email,
            'is_giver' => $this->is_giver,
        ]);

        $this->email = '';
    }
}
