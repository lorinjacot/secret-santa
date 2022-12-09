<p>Salut {{ $player->name }},</p>

<p>Tu as été invité à rejoindre une conversation anonyme sur {{ config('app.name') }}.</p>

<blockquote>
    <p><a href="{{ $receiver_route }}">{{ $receiver_route }}</a></p>
</blockquote>

<p>Ne perds pas ce lien, sinon tu ne pourras plus accéder à la conversation!</p>
