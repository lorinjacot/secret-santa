<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($user->target)
                    <div class="p-6 text-gray-900">
                        La partie a commencé! Ta cible est <b>{{ $user->target->name }}</b>!
                    </div>
                @else
                    <div class="p-6 text-gray-900">
                        Vous avez rejoint le secret santa! Pour le moment, {{ $users_count }} personnes ont rejoint le secret santa.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
