<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServiceGestaoEEstrategiaController extends Controller
{

    /**
     * @OA\Get(
     * path="/shippingcompany/objectstracking",
     * summary="UC03 - Rastreio de objetos/mercadorias da origem ao destino",
     * description="Retorna a URL do  dashboard em PowerBI",
     * operationId="UC03-1",
     * tags={"UC03"},
     * security={{"bearer": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Os valores abaixo sendo informados serão utilizados para busca dos dados",
     *    @OA\JsonContent(
     *       @OA\Property(property="report_id", type="int", example="20210825"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Retorno dos dados",
     *    @OA\JsonContent(
     *       @OA\Property(property="url",type="string",example="https://app.powerbi.com/view?r=eyJrIjoiZjUwZTNiM2MtZDY0Ni00Yzg1LTk3N2MtMTc1OTIyYWEzMzIxIiwidCI6ImU4NWM1NmQ3LTE1MDUtNDhjNy1hMjZjLWRlYWU5MzNmNjAwYSJ9",
     *      )
     *    ),
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

    public function getReport(Request $request, $report_id = null)
    {

        $url = 'nginx-service-gestao-estrategia/api/report';

        if ($report_id != null or $report_id != '') {
            $url .= '/' . $report_id;
        }

        $response = Http::get($url, $request->all());

        return response()->json(
            json_decode($response->getBody()->getContents()),
            $response->getStatusCode()
        );
    }

}
