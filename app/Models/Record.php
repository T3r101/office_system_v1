<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;

use HasFactory;

protected $fillable = [
        'user_id',
        'date',
        'description',
        'category',
        'debit',
        'credit',
        'balance',
    ];

    protected $casts = [
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
        'balance' => 'decimal:2',
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Computed balance
    public function getBalanceAttribute()
    {
        return $this->debit - $this->credit; // Or running balance logic
    }
}

