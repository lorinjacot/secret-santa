<?php

namespace App\Http\Controllers;

use App\Mail\AnonymousMessageMail;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function message_form(Request $request)
    {
        $players_with_partner = Player::where('has_partner', true)->get();
        return view('message_form', [
            'players' => $players_with_partner,
        ]);
    }

    public function send_message(Request $request)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
            'message' => 'required|string',
        ]);
        $player = Player::find($validated['player_id']);

        Mail::to($player->email)->send(new AnonymousMessageMail(
            message_text: $validated['message'],
            player_name: $player->name,
        ));

        return view('send_message', [
            'message' => $validated['message'],
            'player' => $player,
        ]);
    }

    public function signup(Request $request)
    {
        return view('signup');
    }

    public function signedup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:players,name',
            'email' => 'required|email|unique:players,email',
        ]);

        $player = Player::create($validated);

        return view('signedup', [
            'player' => $player,
        ]);
    }
}
