<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use App\Models\PersonalLimit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        $cookie = Cookie::get('Failed_attempt');
        if ($cookie >= 5) {
            return back()->withError('Failed Attempt You Can Login After 6hours');
        }
        if ($cookie !=  null) {
            Cookie::queue('Failed_attempt', $cookie + 1, 360);
        } else {
            Cookie::queue('Failed_attempt', 1, 360);
        }

        $request->validate([
            'email' => ['required',  'email', 'max:255', 'exists:users,email'],
            'password' => ['required', Rules\Password::defaults()],
        ]);


        $user = User::whereEmail($request->email)->first();
        if ($user->attempt == 0) {
            return back()->withError('Failed Attempt The User Can Login After 6hours');
        }

        $remember = $request->remember;

        if (Auth::attempt($request->only('email', 'password'), $remember)) {

            $user->attempt = 3;
            $user->save();

            return redirect()->route('DashboardView');
        }

        $user->attempt = $user->attempt - 1;
        $user->save();


        if ($user->attempt == 0) {
            return back()->with(['alert' => 'Password Not Match', 'error' => 'Failed Attempt You Can Login After 6hours']);
        }
        return back()->with(['alert' => 'Password Not Match', 'failed' => 'Failed,You can try only ' . $user->attempt . ' time more']);
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
