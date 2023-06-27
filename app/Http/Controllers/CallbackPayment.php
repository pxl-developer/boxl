<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mp;
use Illuminate\Support\Facades\Ideris;
use Illuminate\Support\Facades\Response;

class CallbackPayment extends Controller
{
    public function load(Request $request)
    {
        $paymentUpdate = $request->all();

        $paymentInfo = Mp::get('/v1/payments/'.$paymentUpdate['data']['id'])->object();

        $paymentData = Payment::where('transaction_id',$paymentUpdate['data']['id']);

        $paymentData->update(['transaction_status' => $paymentInfo->status]);

        $orderStatus = Ideris::get('/order/'.$paymentData->with('order')->get()->first()->order->code)->object()->obj; 

        if ( $orderStatus->statusId === 1007 ){
            if ( $paymentInfo->status == 'approved' ){
                $updateData = array(
                    'orderId' => $paymentData->with('order')->get()->first()->order->code,
                    'statusId' => 1008,
                );
                
                Ideris::put('/order',$updateData);
            }
        }

        if ( $paymentData->wasChanged() ){
            return Response::json('Atualização de status realizada', 201);
        }
    }
}
