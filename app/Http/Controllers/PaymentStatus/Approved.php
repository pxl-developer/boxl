<?php

namespace App\Http\Controllers\PaymentStatus;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Ideris;
use App\Http\Controllers\PaymentStatus\State;

class Approved implements State
{
    public function handle(Payment $payment)
    {
        $orderID = $payment->with('order')->get()->first();

        $updateData = array(
            'orderId' => $orderID->order->code,
            'statusId' => 1008,
        );
        
        Ideris::put('/order',$updateData);

        Order::find($orderID->order->id)->update(['order_status' => 'APROVADO']);

        $payment->update(['transaction_status' => 'approved']);
    }
}
