<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use App\Models\PersonalLimit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    function LoginView()
    {
        $accounts = AccountType::latest()->select('id', 'name')->get();

        return view('Frontend.Auth.login', compact('accounts'));
    }

    function RegisterPost(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string'],
            'account_type_id' => ['required', 'numeric', 'exists:account_types,id'],
            'email' => ['required',  'email', 'max:255',],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'pin' => ['required', 'numeric', 'min:5'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'account_id' => $request->account_type_id,
            'pin' => bcrypt($request->pin),
            'password' => bcrypt($request->password),
        ]);

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->save();


        if ($request->account_type_id == 2) {

            $account = AccountType::findorfail($request->account_type_id);

            $personal = new PersonalLimit;
            $personal->user_id =  $user->id;
            $personal->add_money_limit = $account->add_money_limit;
            $personal->per_day_money_limit = $account->per_day_money_limit;
            $personal->monthly_limit = $account->monthly_limit;
            $personal->transfer_limit_monthly = $account->transfer_limit_monthly;
            $personal->tranfer_monthly_max = $account->tranfer_monthly_max;
            $personal->tranfer_daily_max = $account->tranfer_daily_max;
            $personal->monthly_cashout_transaction_limit = $account->monthly_cashout_transaction_limit;
            $personal->per_day_cashout_amount_limit = $account->per_day_cashout_amount_limit;
            $personal->per_month_cashout_amount_limit = $account->per_month_cashout_amount_limit;
            $personal->save();
        }



        return response()->json('Registerd Successfully');
    }
    function LoginPost(Request $request)
    {
        $request->validate([
            'email' => ['required',  'email', 'max:255', 'exists:users,email'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $remember = $request->remember;

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            return redirect()->route('DashboardView');
        }
        return back()->with('alert', 'Password Not Match');
    }
    function AuthCodeVerify(Request $request)
    {
        if (Auth::viaRemember() || session('remember')) {
            return view('Frontend.Auth.code');
        }
        return redirect()->route('DashboardView');
    }
    function AuthCodeVerifyPost(Request $request)
    {


        $request->validate([
            'pin' => ['numeric', 'min:5',]
        ]);
        $user = auth('web')->user();

        if (!Hash::check($request->pin, $user->pin)) {
            return response()->json(['pin' => 'Pin Incorrect'], 422);
        }

        session()->forget('remember');

        return response()->json('Redirecting...');
    }
    function Logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
