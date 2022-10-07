<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AgentTransactionController extends Controller
{
    function CashInView()
    {
        return view('Frontend.pages.cash-in');
    }
    function CashInPost(Request $request)
    {
        // return $request;
        $request->validate([
            'email' => ['required', 'email', Rule::exists('users')->where(function ($query) {
                return $query->where('account_id', 2);
            }),],
            'amount' => ['required', 'numeric', 'max:9999999'],
        ]);

        $user = auth('web')->user();
        // $limit = $user->PersonalLimit;
        $wallet = $user->wallet;
        $transcation_id = rand(555, 999999) . $user->id;

        if ($wallet->wallet  == 0) {
            return back()->withError('Your wallet is empty');
        } elseif ($wallet->wallet  < $request->amount) {
            return back()->withError("Currently you don't have enough money");
        }

        // auth transaction
        // $limit->tranfer_monthly_max  = $limit->tranfer_monthly_max  - $request->amount;
        // $limit->tranfer_daily_max  = $limit->tranfer_daily_max  - $request->amount;
        // $limit->transfer_limit_monthly  = $limit->transfer_limit_monthly  - 1;
        // $limit->save();

        $transaction = new Transaction;
        $transaction->transcation_id = $transcation_id;
        $transaction->user_id = $user->id;
        $transaction->from_or_to_email  = $request->email;
        $transaction->amount = $request->amount;
        $transaction->trans_type = 2;
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
        $transaction->trans_type = 2;
        $transaction->status = 1;
        $transaction->save();

        $wallet = $to_user->wallet;
        $wallet->wallet = $wallet->wallet + $request->amount;
        $wallet->save();


        return back()->with('success', 'Add Money Successfull');
    }
}
