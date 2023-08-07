<?php

namespace App\Http\Controllers\PaymentMethods;

interface ICreditCard
{
    public function setToken(String $token): void;
}
