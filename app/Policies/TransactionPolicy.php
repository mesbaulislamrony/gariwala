<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
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

    public function update(User $user, Transaction $transaction)
    {
        return false;
    }

    public function delete(User $user, Transaction $transaction)
    {
        return false;
    }

    public function view(User $user, Transaction $transaction)
    {
        return true;
    }
}
