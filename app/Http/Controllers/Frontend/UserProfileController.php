<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Session as SessionModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    function ProfileView()
    {
        $sessions = SessionModel::where('user_id', auth('web')->id())->get();

        return view('Frontend.profile.index', compact('sessions'));
    }
}
