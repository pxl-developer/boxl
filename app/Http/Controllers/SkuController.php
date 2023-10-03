<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Sku');
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
        $request->validate([
            'sku' => 'required|unique:App\Models\Sku,sku',
            'cost' => 'required|decimal:2',
        ]);

        try{
            Sku::create([
                'sku'  => $request->sku,
                'cost' => $request->cost,
            ]);
            
            return Inertia::render('Sku', [
                'status' => "SKU cadastrado!"
            ]);
        }catch(Exception){
            return Inertia::render('Sku', [
                'status' => "Erro ao cadastrar SKU"
            ]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
