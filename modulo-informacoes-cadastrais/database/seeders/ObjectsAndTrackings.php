<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Services\GeoCodingApiService;

class ObjectsAndTrackings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $GeoCodingApiService =  new GeoCodingApiService;
        DB::table('objects.objects')->delete();
        DB::table('objects.objects_tracking')->delete();
        $tracking_code = '';
        $tracking_code = 'GLS-BR-' . Carbon::now()->addSeconds(rand(0, 3000))->format('YmdHi');
        $obj1 = [
            'obj' =>
            [
                'tracking_code' => $tracking_code,
                'localization_source_address' => 'Rua Carolina Fonseca, 315 - Vila Taquari, São Paulo - SP',
                'localization_source_lat_long' => $GeoCodingApiService->getLatLong("Rua Carolina Fonseca, 315 - Vila Taquari, São Paulo - SP"),
                'localization_destiny_address' => 'Av. José Pinheiro Borges - Itaquera, São Paulo - SP',
                'localization_destiny_lat_long' => $GeoCodingApiService->getLatLong("Av. José Pinheiro Borges - Itaquera, São Paulo - SP"),
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
                    'localization_current_address' => 'Rua Carolina Fonseca, 315 - Vila Taquari, São Paulo - SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Rua Carolina Fonseca, 315 - Vila Taquari, São Paulo - SP"),
                    'date' => Carbon::now()->format('Y-m-d'),
                    'time' => Carbon::now()->format('H:i:s'),
                    'description' => 'OBJETO RETIRADO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current_address' => 'Av. Águia de Haia, 1704 - Parque Paineiras, São Paulo - SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Av. Águia de Haia, 1704 - Parque Paineiras, São Paulo - SP"),
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
                'localization_source_address' => 'Avenida Guilherme Giorgi, 840, São Paulo - SP',
                'localization_source_lat_long' => $GeoCodingApiService->getLatLong("Avenida Guilherme Giorgi, 840, São Paulo - SP"),
                'localization_destiny_address' => 'Rua Enxovia, 472 - Vila Sao Francisco (Zona Sul), São Paulo - SP',
                'localization_destiny_lat_long' => $GeoCodingApiService->getLatLong("Rua Enxovia, 472 - Vila Sao Francisco (Zona Sul), São Paulo - SP"),
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
                    'localization_current_address' => 'Avenida Guilherme Giorgi, 840, São Paulo - SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Avenida Guilherme Giorgi, 840, São Paulo - SP"),
                    'date' => Carbon::now()->format('Y-m-d'),
                    'time' => Carbon::now()->format('H:i:s'),
                    'description' => 'OBJETO RETIRADO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current_address' => 'Alameda Vicente Pinzon, 54 - Vila Olímpia, São Paulo - SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Alameda Vicente Pinzon, 54 - Vila Olímpia, São Paulo - SP"),
                    'date' => Carbon::now()->addDay()->format('Y-m-d'),
                    'time' => Carbon::now()->addDay()->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current_address' => 'Rua Enxovia, 472 - Vila Sao Francisco (Zona Sul), São Paulo - SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong('Rua Enxovia, 472 - Vila Sao Francisco (Zona Sul), São Paulo - SP'),
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
                'localization_source_address' => 'Rua Doná Júlia, 822 - Bal Tres Marias, Peruíbe - SP',
                'localization_source_lat_long' => $GeoCodingApiService->getLatLong("Rua Doná Júlia, 822 - Bal Tres Marias, Peruíbe - SP"),
                'localization_destiny_address' => 'Avenida Guilherme Giorgi, 840 - Vila Carrao, São Paulo - SP',
                'localization_destiny_lat_long' => $GeoCodingApiService->getLatLong("Avenida Guilherme Giorgi, 840 - Vila Carrao, São Paulo - SP"),
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
                    'localization_current_address' => 'Rua Doná Júlia, 822 - Bal Tres Marias, Peruíbe - SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Rua Doná Júlia, 822 - Bal Tres Marias, Peruíbe - SP"),
                    'date' => Carbon::now()->format('Y-m-d'),
                    'time' => Carbon::now()->format('H:i:s'),
                    'description' => 'OBJETO RETIRADO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current_address' => 'Itanhaém, SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Itanhaém, SP"),
                    'date' => Carbon::now()->addDay()->format('Y-m-d'),
                    'time' => Carbon::now()->addDay()->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current_address' => 'Mongaguá, SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Mongaguá, SP"),
                    'date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                    'time' => Carbon::now()->addDays(2)->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current_address' => 'Santos, SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("Santos, SP"),
                    'date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                    'time' => Carbon::now()->addDays(3)->format('H:i:s'),
                    'description' => 'EM TRÂNSITO',
                ],
                [
                    'tracking_code' => $tracking_code,
                    'localization_current_address' => 'São Bernardo do Campo, SP',
                    'localization_current_lat_long' => $GeoCodingApiService->getLatLong("São Bernardo do Campo, SP"),
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
