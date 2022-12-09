<?php

namespace App\Http\Livewire\Conversations;

use Livewire\Component;

class MessageForm extends Component
{
    public $conversation;
    public $is_giver;
    public $content;

    public function render()
    {
        return view('livewire.conversations.message-form');
    }

    public function sendMessage()
    {
        $this->validate([
            'content' => 'required|string',
        ]);
        $this->conversation->messages()->create([
            'content' => $this->content,
            'is_giver' => $this->is_giver,
        ]);
        $this->content = '';
    }
}
