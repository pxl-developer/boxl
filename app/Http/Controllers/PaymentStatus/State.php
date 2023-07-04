<?php

namespace App\Http\Controllers\PaymentStatus;

use App\Models\Payment;

interface State
{
    public function handle(Payment $Payment);
}
