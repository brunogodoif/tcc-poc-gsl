<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Users;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTFactory;

class ReportService
{

    public function get(array $filters)
    {

        return response()->json([
            'report_id' => 90,
            'total' => '500',
            'total_delivered' => 150,
            'total_delayed' => 100,
            'total_in_transport' => 200,
            'total_awaiting_dispatch' => 50,
            'date' => $filters['date']
        ], 200);
    }
}
