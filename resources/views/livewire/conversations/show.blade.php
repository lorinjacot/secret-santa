<div>
    <ul wire:poll>
        @foreach ($conversation->messages as $message)
            <li>
                @if ($message->is_giver)
                    <em>{{ $message->content }}</em>
                @else
                    {{ $message->content }}
                @endif
            </li>
        @endforeach
    </ul>
</div>
