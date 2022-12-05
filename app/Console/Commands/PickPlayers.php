<?php

namespace App\Console\Commands;

use App\Models\Player;
use Illuminate\Console\Command;

class PickPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'players:pick';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Associe à chaque joueur un partenaire';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $players = Player::where('picked_by', null)->get()->shuffle();
        $playersCount = $players->count();
        if ($playersCount == 1) {
            $this->error('Il n\'y a qu\'un seul joueur libre!');
            return 1;
        }
        $players->each(function ($player, $index) use ($playersCount, $players) {
            $nextIndex = $index + 1;
            if ($nextIndex == $playersCount) {
                $nextIndex = 0;
            }
            $nextPlayer = $players[$nextIndex];
            $player->picked_by = $nextPlayer->id;
            $player->save();
        });

        $this->info('Les joueurs ont été associés avec succès!');

        return Command::SUCCESS;
    }
}
