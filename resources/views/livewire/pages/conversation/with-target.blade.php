<?php

use Livewire\Volt\Component;

new class extends Component {
    public $conversation;

    public function mount()
    {
        $this->conversation = auth()->user()->santaConversation;
    }
}; ?>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Conversation avec ta cible 😈
    </h2>
</x-slot>

<div>
    <livewire:conversation :$conversation />
</div>
