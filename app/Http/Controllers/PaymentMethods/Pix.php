<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Mp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PaymentMethods\Method;
use App\Models\Payment;

class Pix implements Method
{

    private $cost;
    private $order_id;

    public function generate(User $user): void
    {
        $paymentRequest = [
            'transaction_amount' => $this->cost,
            'description' => 'Venda Boxl',
            'payment_method_id' => 'pix',
            'notification_url' => 'http://app.pxlsolutions.com.br/api/callback/payment',
            'payer' => [
                'email' => $user->email,
                'first_name' => $user->name,
                'identification' => [
                    'type' => 'CPF',
                    'number' => $user->document
                ],
                'address' => [
                    'zip_code' => $user->address->cep,
                    'street_name' => $user->address->street_name,
                    'street_number' => $user->address->street_number,
                    'neighborhood' => $user->address->neighborhood,
                    'city' => $user->address->city,
                    'federal_unit' => $user->address->uf
                ]
            ]
        ];
        
        $payment = Mp::post('/v1/payments', $paymentRequest)->object();

        Payment::create([
            'transaction_id' => $payment->id,
            'amount' => $payment->transaction_amount,
            'base64_image' => $payment->point_of_interaction->transaction_data->qr_code_base64,
            'payment_pix' => $payment->point_of_interaction->transaction_data->qr_code,
            'transaction_status' => $payment->status,
            'order_id' => $this->order_id,
        ]);
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
}
