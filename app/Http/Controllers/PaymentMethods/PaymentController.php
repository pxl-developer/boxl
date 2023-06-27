<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Mp;

abstract class PaymentController
{
    
    protected function savePayment($data): int
    {
        $execute = Payment::create([
            'amount' => $data->transaction_amount,
            'image' => $data->point_of_interaction->transaction_data->qr_code_base64,
            'transaction_id' => $data->id,
            'transaction_status' => $data->status,
        ]);

        return $execute->id;
    }

    protected function throwPayment($paymentRequest): object
    {
        $post = Mp::post('/v1/payments', $paymentRequest);
        
        if ( ! $post->created() ){
            throw ValidationException::withMessages(['message' => 'Não foi possível gerar o QR code']);
        }

        return $post->object();
    }
}
