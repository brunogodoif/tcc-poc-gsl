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

        $resultCalcFrete = $ShippingService->caclFrete(
            $request->get('weight'),
            $request->get('invoice'),
            $request->get('width'),
            $request->get('length'),
            $request->get('height'),
            $request->get('addressSource'),
            $request->get('addressDestiny'),
        );

        if (isset($resultCalcFrete['message'])) {
            return response()->json(['message' => $resultCalcFrete['message']],  $resultCalcFrete['code']);
        }

        return response()->json($resultCalcFrete,  200);
    }


    public function validateInputsRequest($request)
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
