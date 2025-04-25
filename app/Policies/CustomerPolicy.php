<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
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

    public function update(User $user, Customer $customer)
    {
        return false;
    }

    public function delete(User $user, Customer $customer)
    {
        return false;
    }   
}
