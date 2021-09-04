<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServiceInformacoesCadastraisController extends Controller
{
    public function calculateshipping(Request $request)
    {
        $response = Http::get('nginx-service-informacoes-cadastrais/api/frete/calc', $request->all());

        return response()->json(
            json_decode($response->getBody()->getContents()),
            $response->getStatusCode()
        );
        
    }
}
