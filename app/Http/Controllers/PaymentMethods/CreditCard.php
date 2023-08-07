<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Mp;
use App\Http\Controllers\PaymentMethods\IMethod;
use App\Http\Controllers\PaymentMethods\ICreditCard;

class CreditCard implements IMethod, ICreditCard
{

    private $cost;
    private $order_id;
    private $token;

    public function generate(User $user): void
    {
        $paymentRequest = [
            'transaction_amount' => $this->cost,
            'installments' => 1,
            'description' => 'Venda Boxl',
            'payment_method_id' => $user->credit_card->method_id,
            'notification_url' => 'http://app.pxlsolutions.com.br/api/callback/payment',
            'token' => $this->token,
            'payer' => [
                'type' => 'customer',
                'id' => $user->mp_identification
            ]
        ];
        
        $payment = Mp::post('/v1/payments', $paymentRequest)->object();

        Payment::create([
            'transaction_id' => $payment->id,
            'amount' => $payment->transaction_amount,
            'transaction_status' => $payment->status,
            'order_id' => $this->order_id,
        ]);

        Order::find($this->order_id)->update(['order_status' => 'AGUARDANDO_PAGAMENTO']);
    }

    public function cost(Order $amount): void
    {
        $this->order_id = $amount->id;

        if($amount->delivery_type == "FLEX"){
            $this->cost = $amount->order_cost + 15;
            return;
        }

        $this->cost = $amount->order_cost;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
