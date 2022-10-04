<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function Personal_Account($user)
    {
        if ($user->account_id == 2) {
            return true;
        }
        return false;
    }
    function Agent_AAccount($user)
    {
        if ($user->account_id == 1) {
            return true;
        }
        return false;
    }
}
