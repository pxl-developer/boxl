<?php

namespace App\Console\Commands;

use App\Models\Api;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class IderisToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:ideris';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualização do token da Ideris';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $private_key = Api::where('user','FDB8B530FCD0904410BCE93CC700EAEEEE71A58E18507F33D54BF9778B7E9B7A')->get()->first()->secret;
        
        $token = Http::withBody(json_encode($private_key))
        ->withHeaders(['Content-Type' => 'application/json'])
        ->post('https://apiv3.ideris.com.br/login');
        
        if ( $token->ok() ){
            Api::where('user','FDB8B530FCD0904410BCE93CC700EAEEEE71A58E18507F33D54BF9778B7E9B7A')
            ->update(['access_token' => $token->body()]);

            $this->info('Token atualizado com sucesso');
        }
    }
}
