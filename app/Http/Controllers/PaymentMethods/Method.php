<?php

namespace App\Http\Controllers\PaymentMethods;

interface Method
{
    public function generate(): void;
}
