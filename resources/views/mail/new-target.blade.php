<x-mail::message>
# Un partenaire t'a été attribué !

Salut {{ $name }},

Ton partenaire est {{ $target }}.

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Bonne partie,<br>
{{ config('app.name') }}
</x-mail::message>
