<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'capitalization', 'loan_balance',
    ];

    protected $casts = [
        'capitalization' => 'double',
        'loan_balance' => 'double'
    ];

    
}
