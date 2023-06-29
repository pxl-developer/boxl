<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PaymentMethods\Method;

class Pix implements Method
{

    private $cost;

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
                    'number' => $user->cpf
                ],
                'address' => [
                    'zip_code' => $user->cep,
                    'street_name' => '',
                    'street_number' => '',
                    'neighborhood' => '',
                    'city' => '',
                    'federal_unit' => ''
                ]
            ]
        ];
    }

    public function cost(Order $amount): void
    {
        $this->cost = 10 + 15;
    }
}
