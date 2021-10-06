<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServiceInformacoesCadastraisController extends Controller
{

    /**
     * @OA\Get(
     * path="/shippingcompany/objectstracking",
     * summary="UC01 - Rastreio de objetos/mercadorias da origem ao destino",
     * description="Retorna informações de objetos/mercadorias em transporte",
     * operationId="UC01-1",
     * tags={"UC01"},
     * security={{"bearer": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Os valores abaixo sendo informados serão utilizados para busca dos dados",
     *    @OA\JsonContent(
     *       @OA\Property(property="expected_delivery_date", type="string", example="2021-09-11 - 2021-10-11"),
     *       @OA\Property(property="type_transport", type="string", example="Van | Truck"),
     *       @OA\Property(property="status", type="string", example="AGUARDANDO RETIRADA | EM TRÂNSITO | ENTREGUE")
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Retorno dos dados",
     *    @OA\JsonContent(
     *       @OA\Property(property="data",type="object",example={
    {
        "id": 10,
        "tracking_code": "GLS-BR-202109092040",
        "localization_source_address": "Rua Carolina Fonseca, 315 - Vila Taquari, São Paulo - SP",
        "localization_source_lat_long": "-23.5306441,-46.4553393",
        "localization_destiny_address": "Av. José Pinheiro Borges - Itaquera, São Paulo - SP",
        "localization_destiny_lat_long": "-23.5346409,-46.4535243",
        "total_invoice": "500.00",
        "weight": 25,
        "shipping_cost": "180.00",
        "dispatch_date": "2021-09-09",
        "deadline_in_days": 2,
        "expected_delivery_date": "2021-09-11",
        "type_transport": "Van",
        "status": "EM TRÂNSITO"
    },
    {    
        "id": 11,
        "tracking_code": "GLS-BR-202109092026",
        "localization_source_address": "Avenida Guilherme Giorgi, 840, São Paulo - SP",
        "localization_source_lat_long": "-23.5537135,-46.5453773",
        "localization_destiny_address": "Rua Enxovia, 472 - Vila Sao Francisco (Zona Sul), São Paulo - SP",
        "localization_destiny_lat_long": "-23.6273005,-46.7006828",
        "total_invoice": "5000.00",
        "weight": 250,
        "shipping_cost": "500.00",
        "dispatch_date": "2021-09-09",
        "deadline_in_days": 5,
        "expected_delivery_date": "2021-09-14",
        "type_transport": "Van",
        "status": "ENTREGUE"
    }
     *},description="User notification settings"),
     *       @OA\Property(property="total", type="int", example="3"),
     *        )
     *     ),
     * @OA\Response(
     *    response=400,
     *    description="Parâmetros informados são inválidos ou estão em formato inválido",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid parameters")
     *        )
     *     ),
     * @OA\Response(
     *    response=500,
     *    description="Falha de servidor",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="-> Mensagem com erro de processamento do servidor <-")
     *        )
     *     )
     * )
     */
/**
     * @OA\Get(
     * path="/shippingcompany/objectstracking/{tracking_code}",
     * summary="UC01 - Rastreio de objetos/mercadorias da origem ao destino com datalhemento do rastreio",
     * description="Retorna informações de um objeto/mercadoria juntamente com dados de rastreio",
     * operationId="UC01-2",
     * tags={"UC01"},
     * security={{"bearer": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="O código de rastreio é obrigatório para o funcionamento desta funcionalidade",
     *    @OA\JsonContent(
     *       @OA\Property(property="tracking_code", type="string", example="GLS-BR-202109092040")
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Retorno dos dados",
     *    @OA\JsonContent(
     *       @OA\Property(property="data",type="object",example={{
            "id": 10,
            "tracking_code": "GLS-BR-202109092040",
            "localization_source_address": "Rua Carolina Fonseca, 315 - Vila Taquari, São Paulo - SP",
            "localization_source_lat_long": "-23.5306441,-46.4553393",
            "localization_destiny_address": "Av. José Pinheiro Borges - Itaquera, São Paulo - SP",
            "localization_destiny_lat_long": "-23.5346409,-46.4535243",
            "total_invoice": "500.00",
            "weight": 25,
            "shipping_cost": "180.00",
            "dispatch_date": "2021-09-09",
            "deadline_in_days": 2,
            "expected_delivery_date": "2021-09-11",
            "type_transport": "Van",
            "status": "EM TRÂNSITO",
            "tracking": {{
                {
                    "id": 31,
                    "tracking_code": "GLS-BR-202109092040",
                    "localization_current_address": "Rua Carolina Fonseca, 315 - Vila Taquari, São Paulo - SP",
                    "localization_current_lat_long": "-23.5306441,-46.4553393",
                    "date": "2021-09-09",
                    "time": "20:11:24",
                    "description": "OBJETO RETIRADO"
                },
                {
                    "id": 32,
                    "tracking_code": "GLS-BR-202109092040",
                    "localization_current_address": "Av. Águia de Haia, 1704 - Parque Paineiras, São Paulo - SP",
                    "localization_current_lat_long": "-23.5309506,-46.4737223",
                    "date": "2021-09-10",
                    "time": "20:11:24",
                    "description": "EM TRÂNSITO"
                }
            }}
        }},description="User notification settings"),
     *       @OA\Property(property="total", type="int", example="3"),
     *        )
     *     ),
     * @OA\Response(
     *    response=400,
     *    description="Parâmetros informados são inválidos ou estão em formato inválido",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid parameters")
     *        )
     *     ),
     * @OA\Response(
     *    response=500,
     *    description="Falha de servidor",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="-> Mensagem com erro de processamento do servidor <-")
     *        )
     *     )
     * )
     */
    public function objectstracking(Request $request, $tracking_code = null)
    {

        $url = 'nginx-service-informacoes-cadastrais/api/objects/tracking';

        if ($tracking_code != null or $tracking_code != '') {
            $url .= '/' . $tracking_code;
        }

        $response = Http::get($url, $request->all());

        return response()->json(
            json_decode($response->getBody()->getContents()),
            $response->getStatusCode()
        );
    }

    /**
     * @OA\Get(
     * path="/shippingcompany/calculateshipping",
     * summary="UC02 – Cálculo de frete",
     * description="Retorna o cálculo de frete e tempo estimado de entrega de um objeto/mercadorias com base em suas medidas e peso e distancia entre ponto de origem e destino",
     * operationId="UC02",
     * tags={"UC02"},
     * security={{"bearer": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Abaixo os valores necessários para o calculo do frete",
     *    @OA\JsonContent(
     *       @OA\Property(property="weight", type="string", example="98.00"),
     *       @OA\Property(property="invoice", type="string", example="725"),
     *       @OA\Property(property="width", type="string", example="0.90"),
     *       @OA\Property(property="length", type="string", example="1.50"),
     *       @OA\Property(property="height", type="string", example="0.90"),
     *       @OA\Property(property="addressSource", type="string", example="Av. Contorno, Nº 165 - Setor Norte Ferroviário, Goiânia - GO"),
     *       @OA\Property(property="addressDestiny", type="string", example="R. Carlos Leal Evans, 252 - Jardim Santa Francisca, Guarulhos - SP")
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Retorno do frete calculado e tempo estimado de entrega",
     *    @OA\JsonContent(
     *       @OA\Property(property="data", type="double", example="1.500,00"),
     *       @OA\Property(property="deadline", type="string", example="2 working days"),
     *        )
     *     ),
     * @OA\Response(
     *    response=400,
     *    description="Parâmetros informados são inválidos ou estão em formato inválido",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid parameters")
     *        )
     *     ),
     * @OA\Response(
     *    response=500,
     *    description="Falha de servidor",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="-> Mensagem com erro de processamento do servidor <-")
     *        )
     *     )
     * )
     */
    public function calculateshipping(Request $request)
    {
        $url = 'nginx-service-informacoes-cadastrais/api/frete/calc';
        $response = Http::get($url, $request->all());

        return response()->json(
            json_decode($response->getBody()->getContents()),
            $response->getStatusCode()
        );
    }
}
