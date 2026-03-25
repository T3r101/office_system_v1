<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_number',
        'payee_name',
        'nature_of_payment',
        'office',
        'account_code',
        'specific_fund',
        'amount',
        'type',
        'cheque_date',
        'user_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'cheque_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

