<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

class ExpensePolicy
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
        return true;
    }

    public function update(User $user, Expense $expense)
    {
        return false;
    }

    public function delete(User $user, Expense $expense)
    {
        return false;
    }

    public function view(User $user, Expense $expense)
    {
        return true;
    }
}
