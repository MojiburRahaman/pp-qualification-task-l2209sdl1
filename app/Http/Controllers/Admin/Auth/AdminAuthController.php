<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    function AdminRegister()
    {
        return view('backend.auth.register');
    }
    function AdminLogin()
    {
        return view('backend.auth.login');
    }
    function AdminRegisterPost(Request $request)
    {
        $request->validate([
            'name' => ['required',],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            # code...
            return redirect()->route('DashboardView');
        }
    }
    function AdminLoginPost(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            # code...
            return redirect()->route('DashboardView');
        }
    }
    function AdminLogOut(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        // $request->session()->regenerateToken();
        return redirect('/');
    }
}
