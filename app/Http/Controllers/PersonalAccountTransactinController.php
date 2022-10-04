<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalAccountTransactinController extends Controller
{
    function AddMoney()
    {
        return view('Frontend.pages.add-money');
    }
}
