<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
class DashboardController extends Controller
{
    function DashboardView()
    {
        return  view('backend.main');
    }
}
