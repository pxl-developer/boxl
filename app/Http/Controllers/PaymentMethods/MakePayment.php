<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Models\User;
use App\Models\Order;
use App\Http\Controllers\PaymentMethods\Method;

class MakePayment
{
    public function __construct(
        private Method $method
    ){}

    public function create(User $user, Order $amount): void
    {
        $this->method->cost($amount);

        $this->method->generate($user);
    }
}
