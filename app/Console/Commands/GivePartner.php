<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GivePartner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:give-partner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Associe un partenaire à chaque utilisateur n\'en ayant pas déjà un.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $players = User::whereNull('target_id')->get()->shuffle();
        if ($players->count() <= 1) {
            $this->error('Il n\'y a pas assez de joueurs libres.');
            return 1;
        }

        $players->each(function (User $player, $index) use ($players) {
            $nextIndex = ($index + 1) % $players->count();
            $player->target()->associate($players[$nextIndex])->save();
        });

        $this->info('Les partenaires ont été attribués.');
    }
}
