<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentMethods\Pix;
use App\Http\Controllers\PaymentMethods\MakePayment;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'orders' => Order::where('id_user', Auth::user()->id)->get(),
        ]);
    }
    
    public function pay(Request $request)
    {
        $createPayment = new MakePayment(new Pix());
        
        $createPayment->create(
            User::find(Auth::user()->id)->with('address')->get()->first(),
            Order::find($request->orderID)
        );
    }

    public function wallet(){
        return Inertia::render('Wallet');
    }
}
