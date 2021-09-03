<?php

namespace App\Services;

use App\Models\ShippingWeight;
use App\Services\calculoFrete\ShippingCalculator;

class ShippingService
{



    function __construct()
    {
    }

    public function caclFrete(Float $weight, Float $valueInvoice, Float $width, Float $length, Float $height, String $zipCodeSource, String $zipCodeDestiny)
    {
        //OBTEM A DISTANCE EM KM ENTRE DOIS CEPS
        $DistanceMatrixApiService = new DistanceMatrixApiService;
        $distance = $DistanceMatrixApiService->calculateDistanceBetweenZipCodes($zipCodeSource, $zipCodeDestiny);

        if ($distance == false) {
            return response()->json(['message' => 'It was not possible to obtain the distance between the addresses entered'], 500);
        }

        //INSTANCIA UM ShippingCalculator QUE TEM MÉTODOS PARA CALCULOS DO FRETE
        $shippingCalculator = new ShippingCalculator();

        //ANTES DE CALCULAR O FRETE PESO, É PRECISO VERIFICAR SE O FRETE DEVE SER COBRADO COM BASE NO PESO OU NO VOLUME DA CARGA (CUBAGEM)
        $cubage = $shippingCalculator->calcCubage($width, $length, $height);
        //FAZ CHAMADA A UM METODO QUE FAZ A VERIFICAÇÃO SE O FRETE DEVE SER COBRADO COM BASE NO PESO OU NO VOLUME DA CARGA(CUBAGEM)
        $newWeightobtained = $shippingCalculator->verifyIfWeightCubage($cubage, $weight);

        //FAZ CHAMADA A UM MÉTODO LOCAL QUE FAZ OBTEM DA BASE DE DADOS, OS VALORES E TAXAS MINIMAS PARA UM FRETE, COM BASE NA DISTANCIA E PESO DA CARGA
        $value_ShippingWeight = $this->shippingWeight($distance, $newWeightobtained);

        //FAZ CHAMADA A UM MÉTODO QUE OBTEM O TAXA DE DESPACHO 
        $value_DispatchRate = $shippingCalculator->getDispatchRate();
        //FAZ CHAMADA A UM MÉTODO QUE FAZ O CÁLCULO DO FRETE VALOR, DEVE SER INFORMADO O VALOR DA NOTA FISCAL E O PERCENTUAL DA TAXA DEVE VIR DA TABLE SUGERIDA PELO NTC
        $value_shippingValue = $shippingCalculator->calcShippingValue($valueInvoice, $value_ShippingWeight['percentage_shipping_value']);
        //FAZ CHAMADA A UM MÉTODO QUE FAZ O CÁLCULO DA TAXA DE GERENCIAMENTO DE RISCO, O VALOR PERCENTUAL DEVE VIR DA TABLE SUGERIDA PELO NTC
        $value_RateGRIS = $shippingCalculator->calcRateGRIS($valueInvoice);

        //FAZ CHAMADA A UM MÉTODO QUE FAZ O CÁLCULO DO VALOR DO FRETE BASE, ANTES DAS GENERALIDADES E SERVIÇOS ADICIONAIS
        $PreFreteBase = $shippingCalculator->calcPreFreteBase($value_ShippingWeight['value_shipping_weight'], $value_DispatchRate, $value_shippingValue, $value_RateGRIS);

        //FAZ CHAMADA A UM MÉTODO QUE FAZ O CÁLCULO DO VALOR DA TAXA DE RESTRIÇÃO AO TRÁFEGO
        $value_TrafficRestriction = $shippingCalculator->calcGeneralandAdditionalServicesTrafficRestrictionRate($PreFreteBase);
        //FAZ CHAMADA A UM MÉTODO QUE FAZ O CÁLCULO DO VALOR DA TAXA DE PEDÁGIO
        $value_TollRate = $shippingCalculator->calcGeneralandAdditionalServicesTollRate($newWeightobtained);
        //FAZ CHAMADA A UM MÉTODO QUE FAZ O CÁLCULO DO VALOR TAXA POR SERVIÇOS ADICIONAIS
        $value_Scheduling = $shippingCalculator->calcGeneralandAdditionalServicesScheduling($PreFreteBase);

        //FAZ A SOMA DE TODOS OS VALORES
        $sum = $shippingCalculator->getFinal([
            $value_ShippingWeight['value_shipping_weight'],
            $value_DispatchRate,
            $value_shippingValue,
            $value_RateGRIS,
            $value_TrafficRestriction,
            $value_TollRate,
            $value_Scheduling
        ]);
        //RETORNA O RESULTADO PARA O CONTROLLER

        return [
            'shipping_value' => $sum,
            'deadline' => $value_ShippingWeight['deadline'] . ' working days',
        ];
    }


    public function shippingWeight(Float $distance, Float $newWeightobtained)
    {
        //ESTE MÉTODO DEVE COM BASE NA DISTANCIA E NO PESO DA CARGA, LOCALIZAR NA TABELA DO NTC (TABELA BANCO) O VALOR CORRESPONDENTE AO FRETE PESO
        $ShippingWeight = new ShippingWeight;
        $shippingWeightRow = $ShippingWeight->whereRaw($distance . ' between distance_initial and distance_final ')->get()->first();
        if ($shippingWeightRow == null) {
            return [
                'value_shipping_weight' => 100,
                'percentage_shipping_value' => 0.35,
                'deadline' => 10
            ];
        }
        $field = $this->getShippingWeightFiled($newWeightobtained);


        return [
            'value_shipping_weight' => (float)$shippingWeightRow->$field,
            'percentage_shipping_value' => (float)$shippingWeightRow->percentage_shipping_value,
            'deadline' => (int)$shippingWeightRow->deadline
        ];
    }

    public function getShippingWeightFiled(Float $newWeightobtained)
    {
        $field = null;
        switch (true) {
            case ($newWeightobtained > 200):
                $field = 'above_200';
                break;
            case ($newWeightobtained >= 151 and $newWeightobtained <= 200):
                $field = 'between_151_200';
                break;
            case ($newWeightobtained >= 101 and $newWeightobtained <= 150):
                $field = 'between_101_150';
                break;
            case ($newWeightobtained >= 71 and $newWeightobtained <= 100):
                $field = 'between_71_100';
                break;
            case ($newWeightobtained >= 51 and $newWeightobtained <= 70):
                $field = 'between_51_70';
                break;
            case ($newWeightobtained >= 31 and $newWeightobtained <= 50):
                $field = 'between_31_50';
                break;
            case ($newWeightobtained >= 21 and $newWeightobtained <= 30):
                $field = 'between_21_30';
                break;
            case ($newWeightobtained >= 11 and $newWeightobtained <= 20):
                $field = 'between_11_20';
                break;
            case ($newWeightobtained >= 1 and $newWeightobtained <= 10):
                $field = 'between_1_10';
                break;
            case ($newWeightobtained < 1):
                $field = 'between_1_10';
                break;
            default:
                $field = 'between_31_50';
                break;
        }
        return $field;
    }
}
