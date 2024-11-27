<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Locked;
use Livewire\WithFileUploads;
use App\Notifications\NewMessage;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    #[Locked]
    public $conversation;

    #[Validate('required|string')]
    public $content;

    #[Validate('required|image|mimes:png,jpg,jpeg,gif')]
    public $file;

    public function sendMessage()
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $message =  $this->conversation->messages()->create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';

        $this->sendNotification($message);
    }

    public function sendImage()
    {
        $this->validate([
            'file' => 'required|image|mimes:png,jpg,jpeg,gif',
        ]);

        $message = $this->conversation->images()->create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => auth()->id(),
            'path' => $this->file->store('images', 'public'),
        ]);

        $this->file = null;

        $this->sendNotification($message);
    }   

    protected function sendNotification($message)
    {
        $recipient = $this->conversation->santa;
        if ($message->sender_id === $this->conversation->santa_id) {
            $recipient = $this->conversation->target;
        }
        $recipient->notify(new NewMessage($message));
    }
}; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mx-auto max-w-screen-sm">
            <div class="p-4 space-y-3 h-[50vh] overflow-scroll" x-data x-init="() => { $el.scrollTop = $el.scrollHeight; }" wire:poll>
                @foreach ($conversation->messages->concat($conversation->images)->sortBy('created_at')->values()->all() as $message)
                    @if ($message->sender_id === auth()->user()->id)
                        <div class="p-2 rounded-md max-w-[90%] w-fit ml-auto mr-0 bg-blue-300">
                            @if ($message->content === null)
                                <img src="{{ $message->url }}">
                            @else
                                {{ $message->content }}
                            @endif
                        </div>
                    @else
                        <div class="p-2 rounded-md max-w-[90%] w-fit mr-auto ml-0 bg-violet-300">
                            @if ($message->content === null)
                                <img src="{{ $message->url }}">
                            @else
                                {{ $message->content }}
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
            <form class="p-4 w-fit ml-auto mr-0" wire:submit.prevent="sendMessage">
                <div>
                    <textarea wire:model="content"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button class="border-2 border-blue-300 py-1 px-2 rounded-lg" type="submit">Envoyer</button>
                    <button x-data x-on:click.prevent="$dispatch('open-modal', 'send-image')"
                        class="border-2 border-blue-300 py-1 px-2 rounded-lg">Envoyer une image</button>
                </div>
            </form>
        </div>
    </div>
    <x-modal name="send-image">
        <form x-on:submit.prevent="() => { show=false; $wire.sendImage() }" class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Envoyer une image (attention, les .heic ne sont pas supportés)
            </h2>
            @if ($file)
                <div>
                    <img src="{{ $file->temporaryUrl() }}">
                </div>
            @endif
            <div class="mt-6">
                <input type="file" accept="image/*" name="file" id="file" wire:model="file">
            </div>
            <div class="mt-6 flex justify-end">
                <button class="border-2 border-blue-300 py-1 px-2 rounded-lg" type="submit">Envoyer</button>
            </div>
        </form>
    </x-modal>
</div>
