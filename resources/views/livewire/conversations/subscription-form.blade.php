<form wire:submit.prevent="subscribe">
    @error('email') <span>{{ $message }}</span> @enderror
    <input type="email" wire:model="email">
    <button type="submit">S'abonner</button>
</form>