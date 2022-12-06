<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name' )}}</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <h1>{{ config('app.name') }}</h1>
    <h2>Envoyé!</h2>
    <p>Le message</p>
    <blockquote>
        <p>{{ $message }}</p>
    </blockquote>
    <p>a été envoyé à {{ $player->name }}.</p>
    <p><a href="{{ route('message_form') }}">Envoyer un autre message</a></p>
</body>
</html>