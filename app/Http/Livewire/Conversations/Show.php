<?php

namespace App\Http\Livewire\Conversations;

use Livewire\Component;

class Show extends Component
{
    public $conversation;
    public $is_giver;

    public function render()
    {
        return view('livewire.conversations.show');
    }
}
