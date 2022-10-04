<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use App\Models\User;
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
