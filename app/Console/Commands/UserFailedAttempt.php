<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserFailedAttempt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attempt:failed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Failed Attempt Restore';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('attempt', '!=', 3)->get();

        foreach ($users as $user) {
            $user->attempt = 3;
            $user->save();
        }

        return $this->info('Success');
    }
}
