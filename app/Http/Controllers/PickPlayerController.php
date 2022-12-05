<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PickPlayerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        return view('home');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:players,name',
            'email' => 'required|email|unique:players,email',
        ]);

        $player = Player::create($validated);

        return view('submit', [
            'player' => $player,
        ]);
    }
}
