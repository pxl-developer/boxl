<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use Inertia\Inertia;
use App\Models\Order;
use Inertia\Response;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $orders_opened = Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'PEDIDO_ABERTO')
            ->get();

        $orders_waiting_payment = Payment::whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('transaction_status', 'pending')
            ->get();

        $orders_paid = Payment::whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('transaction_status', 'approved')
            ->get();

        $card = CreditCard::where('user_id', Auth::user()->id)->where('preferencial', 1)->get()->first();
        
        return Inertia::render('Dashboard', [
            'orders'   => $orders_opened,
            'payments' => $orders_waiting_payment,
            'paid'     => $orders_paid,
            'card'     => $card,
            'infos'    => Order::where('user_id', Auth::user()->id)->get()
        ]);
    }
}
