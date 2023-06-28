<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentMethods\Pix;
use App\Http\Controllers\PaymentMethods\CreatePayment;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'orders' => Order::where('id_user', Auth::user()->id)->get(),
            /*paymentsData' => Order::where('id_user', Auth::user()->id)->with('payment')->get(),*/
        ]);
    }
    
    public function pay(Request $request)
    {
        $order = new OrderController($request->orderID);

        $createPayment = new CreatePayment();

        $createPayment->create(new Pix());
    }

    public function wallet(){
        return Inertia::render('Wallet');
    }
}
