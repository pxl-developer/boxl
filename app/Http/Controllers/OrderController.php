<?php

namespace App\Http\Controllers;

use App\Models\Order;

final class OrderController
{
    public function __construct(
        private int $order
    ){}

    protected function findOrder(): Order
    {
        return Order::find($this->order);
    }
}
