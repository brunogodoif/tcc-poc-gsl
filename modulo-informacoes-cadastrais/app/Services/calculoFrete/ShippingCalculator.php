<?php

namespace App\Services\calculoFrete;

class ShippingCalculator
{

    private $valueCubage = 300.00;
    private $DispatchRate = 40.51;
    private $percentualGRIS = 0.30;
    private $ratePercentageTrafficRestriction = 15;
    private $tollRate = 5.36;
    private $ratePercentageScheduling = 20;

    public function calcCubage(Float $width, Float $length, Float $height)
    {
        //FORMULA: Multiplicar a [Altura x Largura x Comprimento] pelo fator de cubagem que a NTC recomenda que seja de 300
        return ($width * $length * $height) * $this->valueCubage;
    }

    public function verifyIfWeightCubage($cubage, $weight)
    {
        /*dd($cubage, $weight); 5424.3  1540.0
        /*  
            > Se o resultado, em kg, for menor que o peso efetivo da carga, então desconsidere este cálculo e use o peso original para formar o seu preço de frete;

            > Mas se o resultado for maior que o peso efetivo da carga, então considere o valor obtido como o novo peso, como base para formar o seu preço pelo transporte.
        */
        if ($cubage < $weight) {
            return $weight;
        }
        return $cubage;
    }

    public function getDispatchRate()
    {
        //RETORNA O VALOR DA TAXA DE DESPACHO, QUE ESTA DEFINIDA COMO ATRIBUTO NA CLASSE
        return $this->DispatchRate;
    }

    public function calcShippingValue(Float $valueInvoice, Float $percentualFreteValor)
    {
        //O cálculo do frete valor é feito com base na fórmula abaixo e nos percentuais indicados sugeridos pela NTC e constantes da Tabela de Frete - Carga Fracionada
        //O PERCENTUAL DEVE VIR DO NTC(TABELA BANCO)
        //FORMULA: Frete Valor = [valor da carga] x [percentual frete valor]
        return round(($valueInvoice * $percentualFreteValor) / 100, 2);
    }

    public function calcRateGRIS(Float $valueInvoice)
    {
        //O cálculo da Taxa de Gerenciamento de Risco é feito com base na fórmula abaixo e nos percentuais sugeridos pela NTC (TABELA BANCO)
        //FORMULA: GRIS = [valor da carga] x [percentual de GRIS]
        return round(($valueInvoice * $this->percentualGRIS) / 100, 2);
    }

    public function calcPreFreteBase($valueShippingWeight, $dispatch, $shippingValue, $rateGRIS)
    {
        //Nesta etapa devem ser somados os valores obtidos a título de Frete Peso, Despacho, Frete Valor e GRIS. 
        //É com base nesse valor que deverão ser calculadas as Generalidades e Serviços Adicionais
        //FORMULA: Frete Base = [Frete peso] + [Despacho] + [Frete valor] + [GRIS]
        return ($valueShippingWeight + $dispatch + $shippingValue + $rateGRIS);
    }


    public function calcGeneralandAdditionalServicesTrafficRestrictionRate(Float $PreshipmentBaseValue)
    {
        //O cálculo da Taxa de Restrição ao Tráfego é feito com base na fórmula abaixo e nos percentuais sugeridos pela NTC (15% sobre o valor do Frete Peso)
        //FORMULA: TRT = [Frete Base] x [percentual de TRT]
        $trt = round(($PreshipmentBaseValue * $this->ratePercentageTrafficRestriction) / 100, 2);
        //Entretanto, neste caso, é importante notar que o valor parcial do frete é inferior ao mínimo de R$ 169,89, implicando na cobrança do valor mínimo de R$ 26,64. Observar os valores mínimos de cada cobrança é fundamental para que a rentabilidade do negócio seja mantida.
        if ($trt < 169.89) {
            return 26.64;
        }
        return $trt;
    }

    public function calcGeneralandAdditionalServicesTollRate(Float $newWeightobtained)
    {
        //O cálculo da Taxa de Pedágio é feito com base na fórmula abaixo e em indicador sugerido pela NTC (R$ 5,36 por fração de 100 kg)
        //FORMULA: (Nº frações de 100 kg = [Peso da mercadoria] / 100 = 1,38 = 2 frações)
        $numberOfFractions = (int)ceil($newWeightobtained / 100);
        return round(($numberOfFractions * $this->tollRate), 2);
    }

    public function calcGeneralandAdditionalServicesScheduling(Float $PreshipmentBaseValue)
    {
        //O cálculo desse Serviço Adcional é feito com base na fórmula abaixo e em indicador sugerido pela NTC (20% sobre o frete base)
        //FORMULA: Agendamento = [frete original] x [percentual de Agendamento]
        return round(($PreshipmentBaseValue * $this->ratePercentageScheduling) / 100, 2);
    }

    public function getFinal(array $valores)
    {
        //FAZ A SOMATORIA DE UM ARRAY DE VALORES
        return array_sum($valores);
    }
}
