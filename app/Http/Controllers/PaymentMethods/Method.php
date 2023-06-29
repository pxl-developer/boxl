<?php

namespace App\Http\Controllers\PaymentMethods;

use App\Models\User;
use App\Models\Order;

interface Method
{
    public function generate(User $user): void;

    public function cost(Order $amount): void;
}
