<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Password;


class MyCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:my-cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $password = Password::find(31);

        // $accesses = $password->users_accesses;

        // dd($accesses);

        dd($password->getAccessForUser(1));
    }
}
