<x-app-layout title="Conversation anonyme créée">
    <h2>Conversation anonyme créée!</h2>
    <p>Voici le lien vers la conversation:</p>
    <blockquote>
        <p><a href="{{ $giver_route }}">{{ $giver_route }}</a></p>
    </blockquote>
    <p>Ne le perds pas, sinon tu ne pourras plus accéder à la conversation!</p>

    <livewire:conversations.subscription-form :conversation="$conversation" :is_giver="true"/>
</x-app-layout>