<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $table = "sessions";


    function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    function GetDevice($user_agent)
    {

        if (preg_match('/linux/i', $user_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $user_agent)) {
            $platform = 'windows';
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
