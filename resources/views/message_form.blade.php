<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <h1>{{ config('app.name') }}</h1>
    <h2>Envoie un message anonyme à ton partenaire!</h2>
    <form action="{{ route('send_message') }}" method="post">
        @csrf
        <div>
            <div>
                <label for="player_id">Sélectionne ton partenaire</label>
            </div>
            <div>
                <select name="player_id" id="player_id">
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <div>
                <label for="message">Message</label>
            </div>
            <div>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div>
            <div>
                <input type="submit" value="Envoyer">
            </div>
        </div>
    </form>
</body>

</html>
