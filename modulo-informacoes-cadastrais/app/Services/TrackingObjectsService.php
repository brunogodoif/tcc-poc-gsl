<?php

namespace App\Services;

use App\Models\Objects;

class TrackingObjectsService
{



    function __construct()
    {
    }

    public function getAll(array $filters)
    {
        $Objects = new Objects;
        try {
            $Objects = $this->addFilters($filters, $Objects);
            $Objects = $Objects->get();
        } catch (\Exception $th) {
            return [
                'message' => $th->getMessage(),
                'code' => 500
            ];
        }

        //RETORNA O RESULTADO PARA O CONTROLLER
        return [
            'data' => $Objects,
            'total' => $Objects->count(),
        ];
    }

    public function getOne(array $filters)
    {
        $Objects = new Objects;
        try {
            $Objects = $this->addFilters($filters, $Objects);
            $Objects = $Objects->with('tracking');
            $Objects = $Objects->get();
        } catch (\Exception $th) {
            return [
                'message' => $th->getMessage(),
                'code' => 500
            ];
        }
        //RETORNA O RESULTADO PARA O CONTROLLER
        return [
            'data' => $Objects,
            'total' => $Objects->count(),
        ];
    }



    private function addFilters(array $filters, Objects $Objects)
    {
        if (count($filters) > 0) {

            if (isset($filters['tracking_code']) && $filters['tracking_code'] != '') {
                $Objects = $Objects->whereTrackingCode($filters['tracking_code']);
            }

            if (isset($filters['status']) && $filters['status'] != '') {
                $Objects = $Objects->whereStatus($filters['status']);
            }

            if (isset($filters['type_transport']) && $filters['type_transport'] != '') {
                $Objects = $Objects->whereTypeTransport($filters['type_transport']);
            }

            if (isset($filters['expected_delivery_date']) && $filters['expected_delivery_date'] != '') {
                $Objects = $Objects->whereBetween('expected_delivery_date',explode(" - ",$filters['expected_delivery_date']));
            }
        }
        return $Objects;
    }
}
