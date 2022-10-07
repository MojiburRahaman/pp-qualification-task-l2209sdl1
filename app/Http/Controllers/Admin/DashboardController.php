<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
class DashboardController extends Controller
{
    function DashboardView()
    {
        return  view('backend.main',[
            'Users'=>User::all(),
        ]);
    }
    function AllTranaction()
    {
        return  view('backend.all-transaction',[
            'Transactions' => Transaction::latest('id')->get(),
        ]);
    }
}
