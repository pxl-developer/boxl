<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'pack_id',
        'order_status',
        'order_total_paid',
        'order_fee',
        'order_cost',
        'delivery_type',
        'user_id',
    ];
}
