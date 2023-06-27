<?php

namespace App\Http\Controllers\PaymentMethods;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PaymentMethods\Method;
use App\Http\Controllers\PaymentMethods\PaymentController;

class Pix extends PaymentController implements Method
{

    public function __construct(
        private Order $order
    ){}

    public function generatePayment(): void
    {
        /** Mudar o CEP para pegar o endereço direto do banco ao invés de uma API */
        $cep = Http::get('https://viacep.com.br/ws/'.Auth::user()->cep.'/json/')->object();

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
                    'street_name' => $cep->logradouro,
                    'street_number' => '0',
                    'neighborhood' => $cep->bairro,
                    'city' => $cep->localidade,
                    'federal_unit' => $cep->uf
                ]
            ]
        ];

        $data = $this->throwPayment($paymentRequest);

        $id = $this->savePayment($data);

        dd($id);
    }

    private function coast(): float
    {
        return $this->order->order_cost + $order->order_fee;
    }
}
