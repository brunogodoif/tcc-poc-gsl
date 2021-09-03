<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Brick\Math\BigDecimal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingWeight extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('freight.shipping_weight')->delete();

        $distance_initial = 0;
        $distance_final = 50;
        $exampleValues = [
            'prince_ton' => BigDecimal::of('283.25'),
            'above_200' => BigDecimal::of('80.00'), //BigDecimal::of('0.28'),
            'between_151_200' => BigDecimal::of('56.65'),
            'between_101_150' => BigDecimal::of('51.41'),
            'between_71_100' => BigDecimal::of('38.81'),
            'between_51_70' => BigDecimal::of('35.69'),
            'between_31_50' => BigDecimal::of('28.33'),
            'between_21_30' => BigDecimal::of('21.24'),
            'between_11_20' => BigDecimal::of('17.56'),
            'between_1_10' => BigDecimal::of('11.90'),
            'percentage_shipping_value' => BigDecimal::of('0.00'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        while ($distance_final <= 10000) {

            $insertRow = [];
            $insertRow['distance_initial'] = $distance_initial;
            $insertRow['distance_final'] = $distance_final;
            $insertRow['prince_ton'] = BigDecimal::of($exampleValues['prince_ton'])->plus(BigDecimal::of($exampleValues['prince_ton'])->multipliedBy(0.05));
            $insertRow['above_200'] = BigDecimal::of($exampleValues['above_200'])->plus(BigDecimal::of($exampleValues['above_200'])->multipliedBy(0.05));
            $insertRow['between_151_200'] = BigDecimal::of($exampleValues['between_151_200'])->plus(BigDecimal::of($exampleValues['between_151_200'])->multipliedBy(0.05));
            $insertRow['between_101_150'] = BigDecimal::of($exampleValues['between_101_150'])->plus(BigDecimal::of($exampleValues['between_101_150'])->multipliedBy(0.05));
            $insertRow['between_71_100'] = BigDecimal::of($exampleValues['between_71_100'])->plus(BigDecimal::of($exampleValues['between_71_100'])->multipliedBy(0.05));
            $insertRow['between_51_70'] = BigDecimal::of($exampleValues['between_51_70'])->plus(BigDecimal::of($exampleValues['between_51_70'])->multipliedBy(0.05));
            $insertRow['between_31_50'] = BigDecimal::of($exampleValues['between_31_50'])->plus(BigDecimal::of($exampleValues['between_31_50'])->multipliedBy(0.05));
            $insertRow['between_21_30'] = BigDecimal::of($exampleValues['between_21_30'])->plus(BigDecimal::of($exampleValues['between_21_30'])->multipliedBy(0.05));
            $insertRow['between_11_20'] = BigDecimal::of($exampleValues['between_11_20'])->plus(BigDecimal::of($exampleValues['between_11_20'])->multipliedBy(0.05));
            $insertRow['between_1_10'] = BigDecimal::of($exampleValues['between_1_10'])->plus(BigDecimal::of($exampleValues['between_1_10'])->multipliedBy(0.05));
            $insertRow['created_at'] = Carbon::now();
            $insertRow['updated_at'] = Carbon::now();


            switch (true) {
                case ($distance_final <= 500):
                    $insertRow['percentage_shipping_value'] = 0.30;
                    $insertRow['deadline'] = 2;
                    break;
                case ($distance_final >= 501 and $distance_final <= 1000):
                    $insertRow['percentage_shipping_value'] = 0.40;
                    $insertRow['deadline'] = 2;
                    break;
                case ($distance_final >= 1001 and $distance_final <= 2000):
                    $insertRow['percentage_shipping_value'] = 0.40;
                    $insertRow['deadline'] = 3;
                    break;
                case ($distance_final >= 2001 and $distance_final <= 3000):
                    $insertRow['percentage_shipping_value'] = 0.50;
                    $insertRow['deadline'] = 3;
                    break;
                case ($distance_final >= 3001 and $distance_final <= 4000):
                    $insertRow['percentage_shipping_value'] = 0.50;
                    $insertRow['deadline'] = 5;
                    break;
                case ($distance_final >= 4001 and $distance_final <= 5000):
                    $insertRow['percentage_shipping_value'] = 0.60;
                    $insertRow['deadline'] = 5;
                    break;
                case ($distance_final >= 5001 and $distance_final <= 6000):
                    $insertRow['percentage_shipping_value'] = 0.60;
                    $insertRow['deadline'] = 6;
                    break;
                case ($distance_final >= 6001):
                    $insertRow['percentage_shipping_value'] = 0.65;
                    $insertRow['deadline'] = 8;
                    break;
                default:
                    $insertRow['percentage_shipping_value'] = 0.35;
                    $insertRow['deadline'] = 10;
                    break;
            }


            DB::table('freight.shipping_weight')->insert($insertRow);

            $exampleValues = $insertRow;

            if ($distance_initial == 0 && $distance_final == 50) {
                $distance_initial = $distance_final + 1;
                $distance_final += $distance_final;
            } else {
                if ($distance_final >= 500) {
                    $distance_initial = $distance_final;
                    $distance_final += 100;
                } else {
                    $distance_initial = $distance_final;
                    $distance_final += 50;
                }
            }
        }
    }
}
