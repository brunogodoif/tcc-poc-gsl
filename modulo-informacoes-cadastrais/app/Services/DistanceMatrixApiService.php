<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class DistanceMatrixApiService
{

    private $key = 'AIzaSyCHxgRusLUMYvD9QIDdL-zRZuU-hYdr7rY';

    function __construct()
    {
    }

    public function calculateDistanceBetweenTwoPoints(String $Source, String $Destiny)
    {

        //MÉTODO QUE FAZ UMA REQUISIÇÃO A API GOOGLE MAPS DISTANCE MATRIX E RETORNA OS DADOS DE DISTANCIA ENTRE DOIS 2 CEPS
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins' => $Source,
                'destinations' => $Destiny,
                'key' => $this->key
            ]);

            if ($response->getStatusCode() == 200) {
                $resultBodyRequest = (object) json_decode($response->getBody()->getContents());
                if ($resultBodyRequest->status != "OK") {
                    throw new Exception($resultBodyRequest->status);
                }
                if (!isset($resultBodyRequest->rows[0]->elements[0]->distance->value)) {
                    throw new Exception("Fail...");
                }
                $distanceValueInKm = ($resultBodyRequest->rows[0]->elements[0]->distance->value) / 1000;
                return (float)$distanceValueInKm;
            } else {
                throw new Exception("DistanceMatrix API request failed");
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
