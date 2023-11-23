<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Locked;

new class extends Component {
    public $conversation;

    public $content;

    public function sendMessage()
    {
        $this->validate([
            'content' => ['required', 'string'],
        ]);
        $this->conversation->messages()->create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';
    }
}; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-auto max-w-screen-sm">
            <div class="p-4" wire:poll>
                @foreach ($conversation->messages as $message)
                    @if ($message->sender_id === auth()->user()->id)
                        <p class="p-2 rounded-md w-fit ml-auto mr-0 bg-blue-300">
                            {{ $message->content }}
                        </p>
                    @else
                        <p class="p-2 rounded-md w-fit mr-auto ml-0 bg-violet-300">
                            {{ $message->content }}
                        </p>
                    @endif
                @endforeach
            </div>
            <form class="p-4 w-fit ml-auto mr-0" wire:submit.prevent="sendMessage">
                <div>
                    <textarea wire:model="content"></textarea>
                </div>
                <div class="flex justify-end">
                    <button class="border-2 border-blue-300 py-1 px-2 rounded-lg" type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
