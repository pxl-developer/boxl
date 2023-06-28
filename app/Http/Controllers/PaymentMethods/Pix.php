<?php

namespace App\Http\Controllers\PaymentMethods;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PaymentMethods\Method;

class Pix implements Method
{
    public function generate(): void
    {
        $paymentRequest = [
            'transaction_amount' => $this->coast(),
            'description' => 'Venda Boxl '.Auth::user()->name,
            'payment_method_id' => 'pix',
            'notification_url' => 'http://app.pxlsolutions.com.br/api/callback/payment',
            'payer' => [
                'email' => Auth::user()->email,
                'first_name' => Auth::user()->name,
                'identification' => [
                    'type' => 'CPF',
                    'number' => Auth::user()->cpf
                ],
                'address' => [
                    'zip_code' => Auth::user()->cep,
                    'street_name' => '',
                    'street_number' => '',
                    'neighborhood' => '',
                    'city' => '',
                    'federal_unit' => ''
                ]
            ]
        ];
    }

    private function coast(): float
    {
        return $this->order->order_cost + $order->order_fee;
    }
}
