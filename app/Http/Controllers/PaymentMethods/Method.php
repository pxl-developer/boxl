<?php

namespace App\Http\Controllers\PaymentMethods;

interface Method
{
 
    public function generatePayment(): void;

    public function coast(): float;
}
