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
                'Authorization' => 'Bearer '.Api::where('user','FDB8B530FCD0904410BCE93CC700EAEEEE71A58E18507F33D54BF9778B7E9B7A')->get()->first()->access_token
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
