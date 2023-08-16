<?php

namespace App\Providers;

use App\Models\Api;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppIderisApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('ideris', function(){
            return Http::withOptions([
                'base_uri' => 'https://apiv3.ideris.com.br/'
            ])->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.Api::where('user','production')->get()->first()->access_token
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
