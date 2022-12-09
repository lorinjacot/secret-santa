<x-app-layout title="Nouvelle conversation">
    <h2>Créer une conversation anonyme avec un autre joueur</h2>
    <form action="{{ route('conversations.store') }}" method="post">
        @csrf
        <label for="receiver_id">Joueur</label>
        <select name="receiver_id" id="receiver_id">
            @foreach ($players as $player)
                <option value="{{ $player->id }}">{{ $player->name }}</option>
            @endforeach
        </select>
        <input type="submit" value="Créer">
    </form>
</x-app-layout>