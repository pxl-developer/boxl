<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditCard extends Model
{
    use HasFactory;

    protected $table = "credit_card";

    protected $fillable = [
        'card_id',
        'card_name',
        'method_id',
        'last_four_digits',
        'expiration_date',
        'preferencial',
        'user_id',
    ];

    protected $casts = [
        'preferencial' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
