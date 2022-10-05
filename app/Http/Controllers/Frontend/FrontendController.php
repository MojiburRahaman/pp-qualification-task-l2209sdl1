<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function DashboardView()
    {
        return view('Frontend.main');
    }
    function TransactionView()
    {
        return view('Frontend.pages.transaction', [
            'Transactions' => Transaction::where('user_id', auth('web')->id())->latest('id')->get(),
        ]);
    }
}
