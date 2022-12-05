<?php

namespace App\Console\Commands;

use App\Mail\PartnerMail;
use App\Models\Player;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'players:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie les partenaires de chaque joueur par email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $players = Player::where('picked_by', '!=', null)->get();
        
        $players->each(function ($player) {
            Mail::to($player->email)->send(new PartnerMail($player->name, $player->pickedBy->name));
        });

        return Command::SUCCESS;
    }
}
