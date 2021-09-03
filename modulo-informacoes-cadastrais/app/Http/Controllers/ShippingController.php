<?php

namespace App\Http\Controllers;

use App\Services\ShippingService;
use Illuminate\Http\Request;

class FreteController extends Controller
{
    public function calc(Request $request)
    {
        $ShippingService = new ShippingService;
        return $ShippingService->caclFrete(
            $request->get('weight'),
            $request->get('invoice'),
            $request->get('width'),
            $request->get('length'),
            $request->get('height'),
            $request->get('zipCodeSource'),
            $request->get('zipCodeDestiny'),
        );
    }
}
