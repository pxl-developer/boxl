<?php

namespace App\Http\Controllers\CreditCard;

use App\Models\User;
use App\Models\CreditCard;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mp;
use Illuminate\Support\Facades\Auth;

class CreditCardController
{
    public $card;
    private $client;

    public function __construct($id) {
        $this->card = CreditCard::where('user_id', $id)->get()->first();

        $this->client = User::find($id);
    }

    /**
     * 
     * 
     * 
     */
    public function verifyIfExist(): bool
    {
        if( $this->client->mp_identification ){
            return true;
        }

        return false;
    }
 
    /**
     * 
     * 
     * 
     */
    public function getMpIdentification(): String
    {
        return $this->client->mp_identification;
    }

    /**
     * 
     * 
     * 
     */
    public function createClient(): void
    {
        $name = explode(' ', $this->client->name);

        $clientRequest = [
            'email' => $this->client->email,
            'first_name' => $name[0],
            'last_name' => $name[1],
            "identification" => [
                "type" => "CPF",
                "number" => $this->client->document
            ],
            "date_registered" => date(DATE_ATOM),
            "default_card" => "None"
        ];
        
        $mp_identification = Mp::post('/v1/customers', $clientRequest)->object();

        $this->client->mp_identification = $mp_identification->id;

        $this->client->save();
    }

    /**
     * 
     * 
     * 
     */
    public function createCard(string $client, string $token): object
    {
        $saveCard = [
            'token' => $token,
        ];

        return Mp::post("/v1/customers/{$client}/cards", $saveCard)->object();
    }

    /**
     * 
     * 
     * 
     */
    public function saveCard($card)
    {
        $card_preferencial = CreditCard::where('user_id', Auth::user()->id)->where('preferencial', 1);
        
        if( $card_preferencial->count() > 0 ){
            $card_preferencial->update([
                'preferencial' => 0
            ]);
        }
        
        CreditCard::create([
            'card_id' => $card->id,
            'card_name' => $card->cardholder->name,
            'method_id' => $card->payment_method->id,
            'last_four_digits' => $card->last_four_digits,
            'expiration_date' => str_pad($card->expiration_month, 2, "0", STR_PAD_LEFT) . "/" . substr($card->expiration_year, 2),
            'preferencial' => 1,
            'user_id' => $this->client->id,
        ]);
    }
}