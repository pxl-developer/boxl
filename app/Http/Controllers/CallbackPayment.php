<?php

namespace App\Http\Controllers;

use DomainException;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mp;
use App\Http\Controllers\PaymentStatus\State;
use App\Http\Controllers\PaymentStatus\Pending;

use App\Http\Controllers\PaymentStatus\Approved;
use App\Http\Controllers\PaymentStatus\Cancelled;

class CallbackPayment extends Controller
{
    private State $state;

    public function __construct(
        private array $stateMap = [
            "pending" => Pending::class,
            "approved" => Approved::class,
            "cancelled" => Cancelled::class,
        ]
    ){}

    public function load(Request $request)
    {
        $callbackInfos = $request->all();

        $paymentDB = Payment::where('transaction_id',$callbackInfos['data']['id'])->get()->first();

        $paymentStatus = Mp::get('/v1/payments/'.$callbackInfos['data']['id'])->object()->status;
    
        if ( $paymentDB->transaction_status == $paymentStatus ){
            throw new DomainException('O pedido já se encontra nesse status');
        }
        
        if (isset($this->stateMap[$paymentStatus])) { 

            $this->state = new $this->stateMap[$paymentStatus];
            
            $this->state->handle($paymentDB);
            
        } else {
            return response()->json([
                "message" => "Método não suportado"
            ], 401);
        }
    }
}
