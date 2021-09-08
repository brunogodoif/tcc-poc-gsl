<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoCodingApiService;
use App\Services\TrackingObjectsService;

class TrackingObjectsController extends Controller
{
    public function getAll(Request $request)
    {
        $GeoCodingApiService = new GeoCodingApiService;

        $TrackingObjectsService = new TrackingObjectsService;

        $result = $TrackingObjectsService->getAll(
            $request->all()
        );

        if (isset($result['message'])) {
            return response()->json(['message' => $result['message']],  $result['code']);
        }

        return response()->json($result,  200);
    }

    public function getOne($tracking_code)
    {
        $TrackingObjectsService = new TrackingObjectsService;

        $tracking_code = trim($tracking_code);

        if ($tracking_code == null or $tracking_code == "") {
            return response()->json(['message' => "Invalid parameters"], 500);
        }

        $result = $TrackingObjectsService->getOne(
            ['tracking_code' => $tracking_code]
        );

        if (isset($result['message'])) {
            return response()->json(['message' => $result['message']],  $result['code']);
        }

        return response()->json($result,  200);
    }


    public function validateInputsRequest($request)
    {
        if (
            !$request->has(['tracking_code'])
            or
            !$request->filled(['tracking_code'])
        ) {
            return false;
        }

        return true;
    }
}
