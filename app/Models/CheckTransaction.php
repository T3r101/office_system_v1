<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckTransaction extends Model
{
    use HasFactory;

    protected $table = 'check_transactions';

    protected $fillable = [
        'check_no',
        'nature_of_payment',
        'specific_fund',
        'amount',
        'date',
        'office',
        'account_code',
        'fund_type',
        'payee_name',
        'user_id'
    ];

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

