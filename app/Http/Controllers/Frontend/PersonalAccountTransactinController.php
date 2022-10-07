<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\AccountType;
use App\Models\ChargeAmount;
use App\Models\Comission;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class PersonalAccountTransactinController extends Controller
{

    function AddMoney()
    {
        return view('Frontend.pages.add-money');
    }

    function AddMoneyPost(Request $request)
    {

        $request->validate([
            'amount' => ['required', 'numeric', 'max:9999999'],
        ]);
        $user = auth('web')->user();
        $limit = $user->PersonalLimit;
        $transcation_id = rand(555, 999999) . $user->id;

        if ($limit->per_day_money_limit == 0) {
            return back()->withError('Daily Add Money Amount Expired');
        } elseif ($limit->per_day_money_limit < $request->amount || $limit->add_money_limit < $request->amount) {

            return back()->withError('Amount is over than limit amount');
        } elseif ($limit->monthly_limit == 0) {

            return back()->withError('Your Monthly Limit Is Over');
        }


        $limit->add_money_limit = $limit->add_money_limit - $request->amount;
        $limit->per_day_money_limit = $limit->per_day_money_limit - $request->amount;
        $limit->monthly_limit = $limit->monthly_limit - 1;
        $limit->save();

        $transaction = new Transaction;
        $transaction->transcation_id = $transcation_id;
        $transaction->user_id = $user->id;
        $transaction->amount = $request->amount;
        $transaction->trans_type = 4;
        $transaction->status = 1;
        $transaction->save();

        $wallet = $user->wallet;
        $wallet->wallet = $wallet->wallet + $request->amount;
        $wallet->save();


        return back()->with('success', 'Add Money Successfull');
    }
    function SendMoneyView()
    {
        return view('Frontend.pages.send-money');
    }
    function SendMoneyPost(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', Rule::exists('users')->where(function ($query) {
                return $query->where('account_id', 2)
                    ->where('email', '!=', auth('web')->user()->email);
            }),],
            'amount' => ['required', 'numeric', 'max:9999999'],
        ]);

        $user = auth('web')->user();
        $limit = $user->PersonalLimit;
        $wallet = $user->wallet;
        $transcation_id = rand(555, 999999) . $user->id;

        if ($limit->tranfer_daily_max  == 0) {
            return back()->withError('Daily Send Money Amount Expired');
        } elseif ($limit->tranfer_monthly_max  < $request->amount || $limit->tranfer_daily_max  < $request->amount) {

            return back()->withError('Amount is over than limit amount');
        } elseif ($limit->transfer_limit_monthly  == 0) {
            return back()->withError('Your Monthly Limit Is Over');
        } elseif ($wallet->wallet  == 0) {
            return back()->withError('Your wallet is empty');
        } elseif ($wallet->wallet  < $request->amount) {
            return back()->withError("Currently you don't have enough money");
        }

        // auth transaction
        $limit->tranfer_monthly_max  = $limit->tranfer_monthly_max  - $request->amount;
        $limit->tranfer_daily_max  = $limit->tranfer_daily_max  - $request->amount;
        $limit->transfer_limit_monthly  = $limit->transfer_limit_monthly  - 1;
        $limit->save();

        $transaction = new Transaction;
        $transaction->transcation_id = $transcation_id;
        $transaction->user_id = $user->id;
        $transaction->from_or_to_email  = $request->email;
        $transaction->amount = $request->amount;
        $transaction->trans_type = 1;
        $transaction->status = 2;
        $transaction->save();

        $wallet->wallet = $wallet->wallet - $request->amount;
        $wallet->save();


        // to user transaction
        $to_user = User::where(['email' => $request->email, 'account_id' => 2])->first();
        $limit = $to_user->PersonalLimit;
        $transcation_id = rand(9555, 999999) . $to_user->id;


        $transaction = new Transaction;
        $transaction->transcation_id = $transcation_id;
        $transaction->user_id = $to_user->id;
        $transaction->amount = $request->amount;
        $transaction->from_or_to_email  = auth('web')->user()->email;
        $transaction->trans_type = 1;
        $transaction->status = 1;
        $transaction->save();

        $wallet = $to_user->wallet;
        $wallet->wallet = $wallet->wallet + $request->amount;
        $wallet->save();


        return back()->with('success', 'Add Money Successfull');
    }
    function CashOutView()
    {
        return view('Frontend.pages.cashout');
    }
    function CashOutViewpost(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', Rule::exists('users')->where(function ($query) {
                return $query->where('account_id', 1);
            }),],
            'amount' => ['required', 'numeric', 'max:9999999'],
        ]);

        if ($request->has('nid')) {
            $request->validate([
                'nid' => ['required'],
            ]);
        }

        $detail = ['nid ' => $request->nid];

        $user = auth('web')->user();
        $limit = $user->PersonalLimit;
        $wallet = $user->wallet;
        $transcation_id = rand(555, 999999) . $user->id;

        $account_type = AccountType::findorfail(2);

        $charge = $account_type->cashout;
        $amount = $request->amount;
        $cashout_charge = ($amount * $charge) / 100;
        $total_amount = $amount + $cashout_charge;

        $agent_commision = AccountType::select('commision', 'id')->findorfail(1);
        $commision_amount = ($cashout_charge * $agent_commision->commision) / 100;

        if ($limit->per_day_cashout_amount_limit  == 0) {
            return back()->withError('Daily Cash Out Amount Expired');
        } elseif ($limit->per_month_cashout_amount_limit  < $request->amount || $limit->per_day_cashout_amount_limit  < $request->amount) {
            return back()->withError('Amount is over than limit amount');
        } elseif ($limit->monthly_cashout_transaction_limit  == 0) {
            return back()->withError('Your Monthly Limit Is Over');
        } elseif ($wallet->wallet  == 0) {
            return back()->withError('Your Wallet is empty');
        } elseif ($wallet->wallet  < $total_amount) {
            return back()->withError("Currently you don't have enough money");
        } elseif ($account_type->min_cashout_amount_per_transaction > $request->amount) {
            return back()->withError("Minimum Cash Out Amount " . $account_type->min_cashout_amount_per_transaction);
        } elseif ($account_type->max_cashout_amount_per_transaction < $request->amount) {
            return back()->withError("Max Cash Out Amount " . $account_type->max_cashout_amount_per_transaction);
        }


        $limit->per_month_cashout_amount_limit  = $limit->per_month_cashout_amount_limit  - $request->amount;
        $limit->per_day_cashout_amount_limit  = $limit->per_day_cashout_amount_limit  - $request->amount;
        $limit->monthly_cashout_transaction_limit  = $limit->monthly_cashout_transaction_limit  - 1;
        $limit->save();

        // user transaction
        $transaction = new Transaction;
        $transaction->transcation_id = $transcation_id;
        $transaction->user_id = $user->id;
        $transaction->from_or_to_email  = $request->email;
        $transaction->amount = $request->amount;
        $transaction->trans_type = 3;
        $transaction->status = 2;
        if ($request->has('nid')) {
            $transaction->details = json_encode($detail);
        }
        $transaction->save();

        $wallet->wallet = $wallet->wallet - $total_amount;
        $wallet->save();


        // to agent transaction
        $to_user = User::where(['email' => $request->email, 'account_id' => 1])->first();
        $transcation_id = rand(9555, 999999) . $to_user->id;


        $transaction = new Transaction;
        $transaction->transcation_id = $transcation_id;
        $transaction->user_id = $to_user->id;
        $transaction->amount = $request->amount;
        $transaction->from_or_to_email  = auth('web')->user()->email;
        $transaction->trans_type = 3;
        $transaction->status = 1;
        if ($request->has('nid')) {
            $transaction->details = json_encode($detail);
        }
        $transaction->save();

        // add amount agent wallet
        $wallet = $to_user->wallet;
        $wallet->wallet = $wallet->wallet + $request->amount + $commision_amount;
        $wallet->save();

        // agent commission
        $comission = new Comission;
        $comission->transcation_id = $transcation_id;
        $comission->commision = $commision_amount;
        $comission->save();

        // rest of the charge deposite another table
        $charge = new ChargeAmount;
        $charge->user_id = auth('web')->id();
        $charge->transcation_id = $transcation_id;
        $charge->charge = $cashout_charge - $commision_amount;
        $charge->save();

        return back()->with('success', 'Cash Out Successfull');
    }
}
