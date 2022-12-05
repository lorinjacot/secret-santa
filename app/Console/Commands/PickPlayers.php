<?php

namespace App\Console\Commands;

use App\Mail\PartnerMail;
use App\Models\Player;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
        $players = Player::where('has_partner', false)->get()->shuffle();
        $playersCount = $players->count();
        if ($playersCount <= 1) {
            $this->error('Il pas assez de joueurs libres!');
            return 1;
        }

        $bar = $this->output->createProgressBar($playersCount);
        $bar->start();

        $players->each(function ($player, $index) use ($playersCount, $players, $bar) {
            $nextIndex = $index + 1;
            if ($nextIndex == $playersCount) {
                $nextIndex = 0;
            }
            $nextPlayer = $players[$nextIndex];
            Mail::to($player->email)->send(new PartnerMail($player->name, $nextPlayer->name));

            $player->has_partner = true;
            $player->save();

            $bar->advance();
        });
        
        $bar->finish();
        $this->newLine();

        $this->info('Les joueurs ont été associés avec succès!');

        return Command::SUCCESS;
    }
}
