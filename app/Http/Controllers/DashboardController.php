<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentMethods\Pix;
use App\Http\Controllers\PaymentMethods\MakePayment;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $orders = Order::where('user_id', Auth::user()->id)
            ->where('order_status', 'PEDIDO_ABERTO')
            ->get();

        $payments = Payment::whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('transaction_status', 'pending')
            ->get();

        $paid = Payment::whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('transaction_status', 'approved')
            ->get();
            
        return Inertia::render('Dashboard', [
            'orders' => $orders,
            'payments' => $payments,
            'paid' => $paid
        ]);
    }
    
    public function pay(Request $request): void
    {
        $createPayment = new MakePayment(new Pix());
        
        $createPayment->create(
            User::find(Auth::user()->id)->with('address')->get()->first(),
            Order::find($request->orderID)
        );
    }
}
