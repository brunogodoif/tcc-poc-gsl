<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReport(Request $request)
    {
        return response()->json(['url' => 'https://app.powerbi.com/view?r=eyJrIjoiZjUwZTNiM2MtZDY0Ni00Yzg1LTk3N2MtMTc1OTIyYWEzMzIxIiwidCI6ImU4NWM1NmQ3LTE1MDUtNDhjNy1hMjZjLWRlYWU5MzNmNjAwYSJ9'],  200);
    }
}
