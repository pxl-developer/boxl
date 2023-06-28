<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Http\Controllers\PaymentMethods\Method;

class CreatePayment
{
    public function create(Method $method): void
    {
        $method->generate();
    }
}
