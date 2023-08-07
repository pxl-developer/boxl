<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentMethods\Pix;
use App\Http\Controllers\PaymentMethods\Validate;
use App\Http\Controllers\PaymentMethods\CreditCard;

class PayController
{
    
    public function __construct(private array $paymentMethod = [
        "pix" => Pix::class,
        "cc" => CreditCard::class,
    ]){}
    
    public function pay(Request $request): void
    {
        $method = new $this->paymentMethod[$request->method];

        Validate::ccToken($method, $request->cardToken);

        $method->cost(Order::find($request->orderID));

        $method->generate(User::find(Auth::user()->id)->with(['address','credit_card'])->get()->first());
    }
}
