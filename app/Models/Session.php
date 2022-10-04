<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = "sessions";
    protected $casts = ["last_activity" => "datetime"];
    
    function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    function GetDevice($user_agent)
    {
        $mobile_agents = '!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i';
        if (preg_match($mobile_agents, $user_agent)) {
            $platform = 'Phone';
        }
        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'Linux';
        } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'Mac';
        } elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'Windows';
        }

        return $platform;
    }

    function GetBrowser($user_agent)
    {

        if (preg_match('/MSIE/i', $user_agent)) {
            $bname = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            $bname = 'Mozilla Firefox';
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            $bname = 'Google Chrome';
        } elseif (preg_match('/Safari/i', $user_agent)) {
            $bname = 'Apple Safari';
        } elseif (preg_match('/Opera/i', $user_agent)) {
            $bname = 'Opera';
        } elseif (preg_match('/Netscape/i', $user_agent)) {
            $bname = 'Netscape';
        }

        return  $bname;
    }
}
