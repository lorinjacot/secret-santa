<x-mail::message>
# Tu as reçu un nouveau message de {{ $name }}:

{{ $content }}

<x-mail::button :url="$link">
Ouvrir la conversation
</x-mail::button>

{{ config('app.name') }}
</x-mail::message>
