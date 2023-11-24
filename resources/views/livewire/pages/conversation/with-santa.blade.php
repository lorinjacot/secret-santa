<?php

use Livewire\Volt\Component;

new class extends Component {
    public $conversation;

    public function mount()
    {
        $this->conversation = auth()->user()->targetConversation;
    }
}; ?>

<div>
    <livewire:conversation :$conversation />
</div>