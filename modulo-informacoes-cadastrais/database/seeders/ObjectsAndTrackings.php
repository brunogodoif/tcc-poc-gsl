<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectsAndTrackings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objects.objects')->delete();
        DB::table('objects.objects_tracking')->delete();
        $tracking_code = '';
        $tracking_code = 'GLS-BR-' . Carbon::now()->addSeconds(rand(0, 3000))->format('YmdHi');
        $obj1 = [
            'obj' =>
            [
                'tracking_code' => $tracking_code,
                'localization_source' => '-23.5306392,-46.457528',
                'localization_destiny' => '-23.5385817,-46.4831554',
                'total_invoice' => '500',
                'weight' => '25',
                'shipping_cost' => '180',
                'dispatch_date' => Carbon::now()->format('Y-m-d'),
                'deadline_in_days' => '2',
                'expected_delivery_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'type_transport' => 'Van',
                'status' => 'EM TRÂNSITO',
            ],
            'tracking' => [
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-23.5306392,-46.457528',
                    'date' => Carbon::now()->format('Y-m-d'),
                    'time' => Carbon::now()->format('H:i:s'),
                    'description' => 'OBJETO RETIRADO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-23.5385817,-46.4831554',
                    'date' => Carbon::now()->addDay()->format('Y-m-d'),
                    'time' => Carbon::now()->addDay()->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ]
            ]
        ];
        DB::table('objects.objects')->insert($obj1['obj']);
        DB::table('objects.objects_tracking')->insert($obj1['tracking']);

        $tracking_code = '';
        $tracking_code = 'GLS-BR-' . Carbon::now()->addSeconds(rand(0, 3000))->format('YmdHi');
        $obj2 = [
            'obj' =>
            [
                'tracking_code' => $tracking_code,
                'localization_source' => '-23.5306392,-46.457528',
                'localization_destiny' => '-23.5269873,-46.4569632',
                'total_invoice' => '5000',
                'weight' => '250',
                'shipping_cost' => '500',
                'dispatch_date' => Carbon::now()->format('Y-m-d'),
                'deadline_in_days' => '5',
                'expected_delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'type_transport' => 'Van',
                'status' => 'ENTREGUE',
            ],
            'tracking' =>
            [
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-23.5306392,-46.457528',
                    'date' => Carbon::now()->format('Y-m-d'),
                    'time' => Carbon::now()->format('H:i:s'),
                    'description' => 'OBJETO RETIRADO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-23.5290966,-46.4551588',
                    'date' => Carbon::now()->addDay()->format('Y-m-d'),
                    'time' => Carbon::now()->addDay()->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-23.5269873,-46.4569632',
                    'date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                    'time' => Carbon::now()->addDays(3)->format('H:i:s'),
                    'description' => 'ENTREGUE',
                ]
            ]
        ];
        DB::table('objects.objects')->insert($obj2['obj']);
        DB::table('objects.objects_tracking')->insert($obj2['tracking']);


        $tracking_code = '';
        $tracking_code = 'GLS-BR-' . Carbon::now()->addSeconds(rand(0, 3000))->format('YmdHi');
        $obj3 = [
            'obj' =>
            [
                'tracking_code' => $tracking_code,
                'localization_source' => '-24.2955832,-46.9760762',
                'localization_destiny' => '-23.553682,-46.5475121',
                'total_invoice' => '1200',
                'weight' => '500',
                'shipping_cost' => '750',
                'dispatch_date' => Carbon::now()->format('Y-m-d'),
                'deadline_in_days' => '5',
                'expected_delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'type_transport' => 'Truck',
                'status' => 'EM TRÂNSITO',
            ],
            'tracking' => [
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-24.2955832,-46.9760762',
                    'date' => Carbon::now()->format('Y-m-d'),
                    'time' => Carbon::now()->format('H:i:s'),
                    'description' => 'OBJETO RETIRADO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-24.2140393,-47.0930857',
                    'date' => Carbon::now()->addDay()->format('Y-m-d'),
                    'time' => Carbon::now()->addDay()->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-24.0891933,-46.7436996',
                    'date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                    'time' => Carbon::now()->addDays(2)->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-24.0365689,-46.6421159',
                    'date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                    'time' => Carbon::now()->addDays(3)->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current' => '-23.5315855,-46.5767664',
                    'date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                    'time' => Carbon::now()->addDays(4)->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ]
            ]
        ];
        DB::table('objects.objects')->insert($obj3['obj']);
        DB::table('objects.objects_tracking')->insert($obj3['tracking']);
    }
}
