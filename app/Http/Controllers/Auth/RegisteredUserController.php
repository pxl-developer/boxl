<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'document' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'phone' => 'required|string|max:255',
            'cep' => 'required|string|max:9',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $CEP = Http::get("https://viacep.com.br/ws/{$request->cep}/json/")->object();

        $validator->after(function ($validator) use ($CEP){
            if ( isset($CEP->erro) ){
                $validator->errors()->add(
                    'cep', 'Erro ao validar o CEP'
                );
            }
        });

        if ( $validator->fails() ){
            return redirect('register')->withErrors($validator);
        }
        
        $user = User::create([
            'authentication_id' => $request->token,
            'name' => $request->name,
            'document' => $request->document,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        dd($CEP);
        Address::create([
            'cep' => $CEP->cep,
            'street_name' => $CEP->logradouro,
            'street_number' => '0',
            'neighborhood' => $CEP->bairro,
            'city' => $CEP->localidade,
            'uf' => $CEP->uf,
            'user_id' => $user->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
