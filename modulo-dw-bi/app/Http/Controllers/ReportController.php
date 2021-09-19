<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{

    public function getDataReport(Request $request)
    {

        $data['date'] = $request->get('date');

        if (!isset($data['date']) or $data['date'] == '') {
            return response()->json(['message' => 'Invalid paramters'], 400);
        }

        $ReportService = new ReportService;
        return $ReportService->get($data);
    }
}
