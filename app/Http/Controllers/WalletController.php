<?php

namespace App\Http\Controllers;

use ErrorException;
use Inertia\Inertia;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = CreditCard::where('user_id', Auth::user()->id)->get();
        
        if( $cards ){
            return Inertia::render('Wallet/Wallet', [
                'cards' => $cards
            ]);
        }
        
        return Inertia::render('Wallet');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $card_preferencial = CreditCard::where('user_id', Auth::user()->id)->where('preferencial', 1)->get()->first();
        $card_change = CreditCard::find($id);
        
        $card_preferencial->preferencial = 0;
        $card_change->preferencial = 1;

        $card_preferencial->save();
        $card_change->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        $card = CreditCard::where('id', $id)->with('user')->get()->first();
        
        if( $card->preferencial ){
            $card_not_preferencial = CreditCard::where('user_id', Auth::user()->id)->where('preferencial', 0)->get();
        
            if( ! $card_not_preferencial->isEmpty() ){
                $card_not_preferencial = $card_not_preferencial->first();
                $card_not_preferencial->preferencial = 1;
                $card_not_preferencial->save();
            }
        }
        
        Mp::delete("/v1/customers/{$card->user->mp_identification}/cards/{$card->card_id}");

        $card->delete();
    }
}
