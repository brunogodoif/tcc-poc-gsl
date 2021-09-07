<?php

namespace App\Http\Controllers;

use App\Services\TrackingObjectsService;
use Illuminate\Http\Request;

class TrackingObjectsController extends Controller
{
    public function index(Request $request)
    {
        $TrackingObjectsService = new TrackingObjectsService;

        /*
        $validateInputs = $this->validateInputsRequest($request);

        if ($validateInputs == false) {
            return response()->json(['message' => "Invalid parameters"], 500);
        }
        */

        $result = $TrackingObjectsService->getAll(
            $request->all()
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
