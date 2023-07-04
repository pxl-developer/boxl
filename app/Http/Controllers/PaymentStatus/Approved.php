<?php

namespace App\Http\Controllers\PaymentStatus;

use App\Models\Payment;
use Illuminate\Support\Facades\Ideris;
use App\Http\Controllers\PaymentStatus\State;

class Approved implements State
{
    public function handle(Payment $payment)
    {
        $orderID = $payment->with('order')->get()->first()->order->code;

        $updateData = array(
            'orderId' => $orderID,
            'statusId' => 1008,
        );
        
        Ideris::put('/order',$updateData);

        $payment->update(['transaction_status' => 'approved']);
    }
}
