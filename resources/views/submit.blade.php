<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription confirmée!</title>
</head>
<body>
    <h1>Merci pour ton inscription {{ $player->name }}!</h1>
    <p>Tu recevras bientôt ton partenaire par mail à <a href="mailto:{{ $player->email }}">{{ $player->email }}</a>.</p>
</body>
</html>