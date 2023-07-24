<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use Inertia\Response;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mp;
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

        $card = Mp::get('/v1/customers/'.Auth::user()->mp_identification.'/cards')->object();
        
        return Inertia::render('Dashboard', [
            'orders' => $orders,
            'payments' => $payments,
            'paid' => $paid,
            'card' => $card[0]->id,
            'infos' => Order::where('user_id', Auth::user()->id)->get()
        ]);
    }
    
    public function pixPay(Request $request): void
    {
        $createPayment = new MakePayment(new Pix());
        
        $createPayment->create(
            User::find(Auth::user()->id)->with('address')->get()->first(),
            Order::find($request->orderID)
        );
    }

    public function ccPay(Request $request): void
    {
        $createPayment = new MakePayment(new Pix());
        
        $createPayment->create(
            User::find(Auth::user()->id)->with('address')->get()->first(),
            Order::find($request->orderID)
        );
    }
}
