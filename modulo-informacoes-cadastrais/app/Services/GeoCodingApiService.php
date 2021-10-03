<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GeoCodingApiService
{

    private $key = 'AIzaSyCHxgRusLUMYvD9QIDdL-zRZuU-hYdr7rY';

    function __construct()
    {
    }

    public function getLatLong($address)
    {
        //MÉTODO QUE FAZ UMA REQUISIÇÃO A API GOOGLE MAPS DISTANCE MATRIX E RETORNA OS DADOS DE DISTANCIA ENTRE DOIS 2 CEPS
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $address,
                'key' => $this->key
            ]);

            if ($response->getStatusCode() == 200) {
                $resultBodyRequest = (object) json_decode($response->getBody()->getContents());
                if ($resultBodyRequest->status != "OK") {
                    throw new Exception($resultBodyRequest->status);
                }
                if (!isset($resultBodyRequest->results[0]->geometry->location)) {
                    throw new Exception("Fail...");
                }
                $latlng = $resultBodyRequest->results[0]->geometry->location->lat . ',' . $resultBodyRequest->results[0]->geometry->location->lng;
                return $latlng;
            } else {
                throw new Exception("GeoCoding API request failed");
            }
        } catch (\Exception $th) {
            /* if ($th->getMessage() != '') {
                return ["message" => $th->getMessage()];
            }
           */
            return false;
        }
    }
}
