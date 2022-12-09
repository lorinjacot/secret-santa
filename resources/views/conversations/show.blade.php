<x-app-layout title="Conversation anonyme">
    <h2>Conversation anonyme</h2>
    <livewire:conversations.show :conversation="$conversation" :is_giver="$is_giver"/>
    <h3>Ecrire un message</h3>
    <livewire:conversations.message-form :conversation="$conversation" :is_giver="$is_giver"/>
    <h3>S'abonner à la conversation</h3>
    <livewire:conversations.subscription-form :conversation="$conversation" :is_giver="$is_giver"/>
</x-app-layout>