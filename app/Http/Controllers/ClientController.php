<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'address'           => 'required',
            'phone'             => 'required',
            'capitalization'    => 'required|numeric',
        ]);
        return Client::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return Client::find($client);
    }

    public function balance() {

        return Client::where('loan_balance', '>', 0)->orderBy('name')->get();

    }

    public function dividend() {

        $clients = Client::get();
        $subset = $clients->map(function ($clients) {
            return collect(
                [
                    'name'      => $clients->name,
                    'dividend'  => $clients->capitalization * 0.023,
                ]
            );
        });

        return response()->json($subset);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    public function deposit(Client $client, $amount) {

        $data = [
            'client'    => $client->id,
            'amount'    => $amount,
        ];
        
        $validator = Validator::make($data, [
            'client' => 'required|numeric|exists:clients,id',
            'amount' => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->all()], 400);
        }

        $client->update(['capitalization' => $client->capitalization + $amount]);

        return $client;
    
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
