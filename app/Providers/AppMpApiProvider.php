<?php

namespace App\Providers;

use App\Models\Api;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppMpApiProvider extends ServiceProvider
{
    /**
     * Register services.
     * 
     */
    public function register(): void
    {
        $this->app->bind('mp', function(){
            return Http::withOptions([
                'base_uri' => 'https://api.mercadopago.com'
            ])->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.Api::where('user','1282882601')->get()->first()->access_token
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
