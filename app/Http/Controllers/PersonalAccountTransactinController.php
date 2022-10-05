<?php

namespace App\Http\Controllers;

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
        $transaction->from_or_to_email  = $request->email;
        $transaction->trans_type = 1;
        $transaction->status = 1;
        $transaction->save();

        $wallet = $to_user->wallet;
        $wallet->wallet = $wallet->wallet + $request->amount;
        $wallet->save();


        return back()->with('success', 'Add Money Successfull');
    }
}
