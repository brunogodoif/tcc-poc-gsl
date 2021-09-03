<?php

namespace App\Http\Controllers;

use App\Services\FreteService;
use Illuminate\Http\Request;

class FreteController extends Controller
{
    public function calc(Request $request)
    {
        $FreteService = new FreteService;
        return $FreteService->caclFrete(
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
