<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Services\ClientServices;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $client;

    public function __construct(ClientServices $service) {
        $this->middleware('auth:api', ['except' => ['apiFakeStore']]);
        $this->client = $service;
    }

    public function store(ClientRequest $clientRequest) 
    {
        $client = $this->client->store($clientRequest); 
        return response()->json($client);
    }

    public function update(ClientRequest $clientRequest) 
    {
        $client = $this->client->update($clientRequest);      
        return response()->json($client);
    }

    public function delete($id)
    {
        $message = $this->client->delete($id);    
        return response()->json($message);
    }

    public function show(Request $request)
    {
        if ($request->id || $request->full_name || $request->cpf) {
            $response = $this->client->getEntity($request->id, $request->full_name, $request->cpf);
        } else {
            $response = $this->client->getAll();
        }
        return response()->json($response);
    }

    public function apiFakeStore($cliente_id = null)
    {
        $client = $this->client->apiFakeStore($cliente_id);
        return response()->json($client);
    }
}