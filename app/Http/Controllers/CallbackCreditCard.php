<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mp;
use Illuminate\Support\Facades\Auth;

class CallbackCreditCard extends Controller
{
    public function handle(Request $request)
    {
        $callbackInfos = $request->all();

        if( !Auth::user()->mp_identification ){
            $clientID = $this->client(Auth::user());
        }else{
            $clientID = Auth::user()->mp_identification;
        }
        
        if( $this->save($clientID, $callbackInfos['token']) ){
            return response()->json([
                "message" => "Cartão cadastrado com sucesso"
            ]);
        }
    }

    public function client(User $user): string
    {
        $name = explode(' ', $user->name);

        $clientRequest = [
            'email' => $user->email,
            'first_name' => $name[0],
            'last_name' => $name[1],
            "identification" => [
                "type" => "CPF",
                "number" => $user->document
            ],
            "date_registered" => date(DATE_ATOM),
            "default_card" => "None"
        ];
        
        $client = Mp::post('/v1/customers', $clientRequest)->object();

        User::find($user->id)->update(['mp_identification' => $client->id]);

        return $client->id;
    }

    public function save(string $client, string $token): bool
    {
        $saveCard = [
            'token' => $token,
        ];

        Mp::post("/v1/customers/{$client}/cards", $saveCard);

        return true;
    }
}
