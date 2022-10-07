<?php

namespace App\Console\Commands;

use App\Models\AccountType;
use App\Models\PersonalLimit;
use Illuminate\Console\Command;
use PhpParser\Node\Stmt\Foreach_;

class PersonalAccountLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'persoanllimit:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Personal User Limit Update Monthly';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $limit = AccountType::findorfail(2);

        $monthly_add_money_limit = $limit->add_money_limit;
        $monthly_transfer_money_limit = $limit->tranfer_monthly_max;
        $add_money_limit_monthly = $limit->monthly_limit;
        $transfer_limit_monthly = $limit->transfer_limit_monthly;
        $per_month_cashout_amount_limit = $limit->per_month_cashout_amount_limit;
        $monthly_cashout_transaction_limit = $limit->monthly_cashout_transaction_limit;

        $User_limit = PersonalLimit::all();

        foreach ($User_limit as $user) {
            $user->add_money_limit = $monthly_add_money_limit;
            $user->tranfer_monthly_max = $monthly_transfer_money_limit;
            $user->monthly_limit = $add_money_limit_monthly;
            $user->transfer_limit_monthly = $transfer_limit_monthly;
            $user->per_month_cashout_amount_limit = $per_month_cashout_amount_limit;
            $user->monthly_cashout_transaction_limit = $monthly_cashout_transaction_limit;
            $user->save();
        }

        return $this->info('Success');
        return Command::SUCCESS;
    }
}
