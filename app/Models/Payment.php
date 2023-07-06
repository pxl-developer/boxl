<?php

namespace App\Models;

use App\Models\Order;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'amount',
        'base64_image',
        'payment_pix',
        'transaction_status',
        'order_id',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y H:i');
    }
}
