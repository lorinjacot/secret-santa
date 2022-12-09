<div>
    <ul wire:poll>
        @forelse ($conversation->messages as $message)
            <li>
                {{-- <small>{{ $message->created_at }}</small> --}}
                @if ($message->is_giver === $is_giver)
                    <em>{{ $message->content }}</em>
                @else
                    {{ $message->content }}
                @endif
            </li>
        @empty
            <p>Aucun message</p>
        @endforelse
    </ul>
</div>
