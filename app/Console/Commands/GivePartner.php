<?php

namespace App\Console\Commands;

use App\Mail\NewTarget;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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

        $players->each(function (User $santa, $index) use ($players) {
            $targetIndex = ($index + 1) % $players->count();
            $santa->target()->associate($players[$targetIndex])->save();
            Conversation::create([
                'santa_id' => $santa->id,
                'target_id' => $players[$targetIndex]->id,
            ]);
        });

        $this->info('Les partenaires ont été attribués.');

        $players->each(function (User $player) {
            Mail::to($player)->send(new NewTarget($player->name, $player->target->name));
        });

        $this->info('Les emails ont été envoyés.');
    }
}
