<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }
    
    public function reservation(User $user, Reservation $reservation)
    {
        if($user->hasRole(['owner','admin']))
        {
            return $user->id === $reservation->room->object->user->id;
        }
        else {
            return $user->id === $reservation->user_id;
        }
    }
}
