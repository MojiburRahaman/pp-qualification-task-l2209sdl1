<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;


    public function User()
    {
        return $this->hasOne(User::class,'account_id');
    }
}
