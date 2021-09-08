<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServiceInformacoesCadastraisController extends Controller
{
    public function calculateshipping(Request $request)
    {
        $url = 'nginx-service-informacoes-cadastrais/api/frete/calc';
        $response = Http::get($url, $request->all());

        return response()->json(
            json_decode($response->getBody()->getContents()),
            $response->getStatusCode()
        );
    }

    public function objectstracking(Request $request, $tracking_code = null)
    {

        $url = 'nginx-service-informacoes-cadastrais/api/objects/tracking';

        if ($tracking_code != null or $tracking_code != '') {
            $url .= '/' . $tracking_code;
        }

        $response = Http::get($url, $request->all());

        return response()->json(
            json_decode($response->getBody()->getContents()),
            $response->getStatusCode()
        );
    }
}
