<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Http\Controllers\PaymentMethods\CreditCard;

abstract class Validate
{
    public static function ccToken($method, $token): void
    {
        if( $method instanceof CreditCard ){
            $method->setToken($token);
        }
    }
}
