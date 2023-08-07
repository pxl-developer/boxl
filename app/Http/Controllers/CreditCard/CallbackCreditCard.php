<?php

namespace App\Http\Controllers\CreditCard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CreditCard\CreditCardController;

class CallbackCreditCard
{
    public function handle(Request $request)
    {
        $callbackInfos = $request->all();

        $creditCard = new CreditCardController(Auth::user()->id);
        
        if( ! $creditCard->verifyIfExist() ){
            $creditCard->createClient();
        }

        $mp_identification = $creditCard->getMpIdentification();

        $card = $creditCard->createCard($mp_identification, $callbackInfos['token']);

        $creditCard->saveCard($card);
    }
}
