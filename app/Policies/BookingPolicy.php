<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Booking $booking)
    {
        return false;
    }

    public function delete(User $user, Booking $booking)
    {
        return false;
    }
}
