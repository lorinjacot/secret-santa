<form wire:submit.prevent="sendMessage">
    <input type="text" wire:model="content">
    <button type="submit">Envoyer</button>
</form>