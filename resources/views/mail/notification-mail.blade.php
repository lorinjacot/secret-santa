<p>Salut, tu as des messages non lus :</p>

<ul>
    @foreach($messages as $message)
        <li>{{ $message->content }}</li>
    @endforeach
</ul>

<p><a href="{{ $conversation_url }}">Voir la conversation et répondre.</a></p>