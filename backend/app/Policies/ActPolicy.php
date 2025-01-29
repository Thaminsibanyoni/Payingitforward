<?php

namespace App\Policies;

use App\Models\Act;
use App\Models\User;

class ActPolicy
{
    public function complete(User $user, Act $act)
    {
        return $act->receiver_id === $user->id;
    }

    public function payForward(User $user, Act $act)
    {
        return $act->receiver_id === $user->id && 
               $act->status === 'completed';
    }
}
