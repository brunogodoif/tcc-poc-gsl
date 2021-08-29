<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    private $valorDeCubagem = 300;
    private $valordaTaxaDeDespacho = 61;
    private $percentualRestricaoAoTrafego = 15;
    private $percentualAgendamento = 20;
    private $taxaDePedagio = 5.36;

    public function teste(Request $request)
    {

        /*IDENTIFICAÇÃO DAS MEDIDAS DA CARGA*/
        $peso = 98;
        $notaFiscal = 725;
        $largura = 0.60;
        $comprimento = 1.10;
        $altura = 0.75;

        //IDENTIFICAÇÃO DA DISTANCIA ENTRE ORIGEM E DESTION
        $distancia = $this->calcularDistanciaEntreOsDestinos(0, 0);

        $cubagem = $this->calculoCubagem($comprimento, $largura, $altura);


        $novoPesoObitido = $this->verficaSeoFreteSeraCobradoNoPesoOuVolumeDaCarga($cubagem, $peso);


        $fretePeso = $this->calculoDoFretePeso($distancia, $novoPesoObitido);


        $valorTaxaDeDespacho = $this->calcularTaxaDeDespacho();


        $freteValor = $this->calcularFreteValor($notaFiscal, 0.60);


        $valorTaxaGerenciamentoDeRisco = $this->calcularTaxaGRIS($notaFiscal, 0.30);

        $valorPreFreteBase = $this->calcularPreFreteBase($fretePeso, $valorTaxaDeDespacho, $freteValor, $valorTaxaGerenciamentoDeRisco);

        $GeneralidadesTaxaDeRestriçãoAoTrafego =  $this->calcularGeneralidadesEServiçosAdicionaisTaxaRestriçãoAoTrafego($valorPreFreteBase);


        $GeneralidadesTaxaDePedagio =  $this->calcularGeneralidadesEServiçosAdicionaisTaxaDePedagio($novoPesoObitido);

        $GeneralidadesTaxaDeAgendamento =  $this->calcularGeneralidadesEServiçosAdicionaisAgendamento($valorPreFreteBase);

        $valorFinal = $this->calcularValorFinalDoFrete([$fretePeso, $valorTaxaDeDespacho, $freteValor, $valorTaxaGerenciamentoDeRisco, $GeneralidadesTaxaDeRestriçãoAoTrafego, $GeneralidadesTaxaDePedagio, $GeneralidadesTaxaDeAgendamento]);

        return $valorFinal;
    }


    public function verficaSeoFreteSeraCobradoNoPesoOuVolumeDaCarga($cubagem, $peso)
    {
        /*  
            > Se o resultado, em kg, for menor que o peso efetivo da carga, então desconsidere este cálculo e use o peso original para formar o seu preço de frete;

            > Mas se o resultado for maior que o peso efetivo da carga, então considere o valor obtido como o novo peso, como base para formar o seu preço pelo transporte.
        */
        if ($cubagem < $peso) {
            return $peso;
        }
        return $cubagem;
    }


    public function calculoCubagem($comprimento = 0, $largura = 0, $altura = 0)
    {
        //FORMULA: Multiplicar a [Altura x Largura x Comprimento] pelo fator de cubagem que a NTC recomenda que seja de 300
        return ($comprimento * $largura * $altura) * $this->valorDeCubagem;
    }

    public function calculoDoFretePeso($distancia, $peso)
    {
        //CRIAR TABELA PRA CONSULTAR ESSE DADO
        //FORMULA: Multiplicar a [Altura x Largura x Comprimento] pelo fator de cubagem que a NTC recomenda que seja de 300
        return 90.91;
    }

    public function calcularDistanciaEntreOsDestinos($cepOrigem, $cepDestion)
    {
        return 785;
    }

    public function calcularTaxaDeDespacho()
    {
        return $this->valordaTaxaDeDespacho;
    }

    public function calcularFreteValor($valorDaCarga, $percentualFreteValor)
    {
        //FORMULA: Frete Valor = [valor da carga] x [percentual frete valor]
        $percentualFreteValor = 0.60;
        return round(($valorDaCarga * $percentualFreteValor) / 100, 2);
    }

    public function calcularTaxaGRIS($valorDaCarga, $percentualGRIS)
    {
        //FORMULA: GRIS = [valor da carga] x [percentual de GRIS]
        $percentualGRIS = 0.30;
        return round(($valorDaCarga * $percentualGRIS) / 100, 2);
    }


    public function calcularPreFreteBase($fretePeso, $despacho, $freteValor, $Gris)
    {
        //FORMULA: Frete Base = [Frete peso] + [Despacho] + [Frete valor] + [GRIS]
        return ($fretePeso + $despacho + $freteValor + $Gris);
    }

    public function calcularGeneralidadesEServiçosAdicionaisTaxaRestriçãoAoTrafego($valorPreFreteBase)
    {
        //FORMULA: TRT = [Frete Base] x [percentual de TRT]
        $percentualRestricaoAoTrafego = 15;
        $trt = round(($valorPreFreteBase * $percentualRestricaoAoTrafego) / 100, 2);
        //Entretanto, neste caso, é importante notar que o valor parcial do frete é inferior ao mínimo de R$ 169,89, implicando na cobrança do valor mínimo de R$ 26,64. Observar os valores mínimos de cada cobrança é fundamental para que a rentabilidade do negócio seja mantida.
        if ($trt < 169.89) {
            return 26.64;
        }
        return $trt;
    }

    public function calcularGeneralidadesEServiçosAdicionaisTaxaDePedagio($novoPesoObitido)
    {
        //FORMULA: (Nº frações de 100 kg = [Peso da mercadoria] / 100 = 1,38 = 2 frações)
        //*O cálculo da Taxa de Pedágio é feito com base na fórmula abaixo e em indicador sugerido pela NTC (R$ 5,36 por fração de 100 kg)
        $numeroDeFracoes = (int)ceil($novoPesoObitido / 100);
        $taxaDePedagio = 5.36;
        return round(($numeroDeFracoes * $taxaDePedagio), 2);
    }

    public function calcularGeneralidadesEServiçosAdicionaisAgendamento($valorPreFreteBase)
    {
        //FORMULA: Agendamento = [frete original] x [percentual de Agendamento]
        $percentualAgendamento = 20;
        return round(($valorPreFreteBase * $percentualAgendamento) / 100, 2);
    }

    public function calcularValorFinalDoFrete(array $valores)
    {
        return array_sum($valores);
    }
}
