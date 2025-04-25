<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'basic_salary',
        'allowance',
        'commission_rate',
        'net_salary',
        'balance',
        'joining_date',
        'note',
    ];
}
