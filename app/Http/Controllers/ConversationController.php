<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Player;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function create()
    {
        return view('conversations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|integer|exists:players,id',
        ]);
        $receiver = Player::findOrFail($validated['receiver_id']);

        $conversation = Conversation::create();

        return view('conversations.store', [
            'giver_route' => route('conversations.show_giver', $conversation),
        ]);
    }

    public function show_giver(Conversation $conversation)
    {
        return view('conversations.show', [
            'conversation' => $conversation,
            'is_giver' => true,
        ]);
    }

    public function show_receiver(Conversation $conversation)
    {
        return view('conversations.show', [
            'conversation' => $conversation,
            'is_giver' => false,
        ]);
    }
}
