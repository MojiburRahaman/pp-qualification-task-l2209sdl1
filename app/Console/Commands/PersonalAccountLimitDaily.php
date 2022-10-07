<?php

namespace App\Console\Commands;

use App\Models\AccountType;
use App\Models\PersonalLimit;
use Illuminate\Console\Command;

class PersonalAccountLimitDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'personallimit:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Personal User Limit Update Daily';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = AccountType::findorfail(2);

        $daily_add_money_limit = $limit->per_day_money_limit;
        $daily_transfer_money_limit = $limit->tranfer_daily_max;
        $per_day_cashout_amount_limit = $limit->per_day_cashout_amount_limit;

        $User_limit = PersonalLimit::all();

        foreach ($User_limit as $user) {
            $user->per_day_money_limit = $daily_add_money_limit;
            $user->tranfer_daily_max = $daily_transfer_money_limit;
            $user->per_day_cashout_amount_limit = $per_day_cashout_amount_limit;
            $user->save();
        }

        return $this->info('Success');
        return Command::SUCCESS;
    }
}
