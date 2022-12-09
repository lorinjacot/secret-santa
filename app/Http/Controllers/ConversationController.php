<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConversationController extends Controller
{
    public function create()
    {
        $players = Player::where('has_partner', true)->get();
        return view('conversations.create', [
            'players' => $players,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|integer|exists:players,id',
        ]);
        $receiver = Player::findOrFail($validated['receiver_id']);

        $conversation = Conversation::create();

        Mail::to($receiver->email)->queue(new \App\Mail\ConversationInvitationMail(
            receiver_route: route('conversations.show_receiver', $conversation),
            player: $receiver,
        ));

        return view('conversations.store', [
            'giver_route' => route('conversations.show_giver', $conversation),
            'conversation' => $conversation,
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
