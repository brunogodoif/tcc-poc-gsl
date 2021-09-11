<?php

namespace App\Http\Controllers;

use App\Services\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function calc(Request $request)
    {
        $ShippingService = new ShippingService;

        $validateInputs = $this->validateInputsRequest($request);

        if ($validateInputs == false) {
            return response()->json(['message' => "Invalid parameters"], 400);
        }

        $resultCaclFreight = $ShippingService->caclFreight(
            $request->get('weight'),
            $request->get('invoice'),
            $request->get('width'),
            $request->get('length'),
            $request->get('height'),
            $request->get('addressSource'),
            $request->get('addressDestiny'),
        );

        if (isset($resultCaclFreight['message'])) {
            return response()->json(['message' => $resultCaclFreight['message']],  $resultCaclFreight['code']);
        }

        return response()->json($resultCaclFreight,  200);
    }


    private function validateInputsRequest(Request $request)
    {
        if (
            !$request->has(['weight', 'invoice', 'width', 'length', 'height', 'addressSource', 'addressDestiny'])
            or
            !$request->filled(['weight', 'invoice', 'width', 'length', 'height', 'addressSource', 'addressDestiny'])
        ) {
            return false;
        }
        return true;
    }
}
