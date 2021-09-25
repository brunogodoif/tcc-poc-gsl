<?php

use Carbon\Carbon;

if (!$data) {

  $data = (object) [
    "total" => "0",
    "total_delivered" => 0,
    "total_delayed" => 0,
    "total_in_transport" => 0,
    "total_awaiting_dispatch" => 0,
    "date" => '1990-01-01',
    "user" => [
      "name" => "bruno",
      "email" => "brunofgodoi@outlook.com.br",
    ]
  ];
}
?>
<html lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <style type="text/css">
    body {
      line-height: 1;
    }

    ol,
    ul {
      list-style: none;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100vh;
      background-color: #E5E5E5;
    }


    .container .box {
      height: auto;
      width: 500px;
      background-color: #FFFFFF;
      border-radius: 3px;
      box-shadow: 2px 3px 10px rgba(0, 0, 0, 0.15);
      padding: 30px;
    }

    .container .box h1 {
      width: 100%;
      font-size: 40px;
      font-family: "Montserrat", sans-serif;
      margin-bottom: 50px;
      font-weight: 700;
      color: #005AFF;
      text-align: center;
    }

    .container .box .form-box {
      width: 100%;
    }

    .container .box .form-box div {
      width: inherit;
    }

    .container .box .form-box div label {
      font-family: "Montserrat", sans-serif;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 10px;
      display: block;
    }

    .form-row {
      margin-top: 10px;
      font-weight: 800;
    }

    .input-form {
      margin-top: 10px;
      font-weight: normal;
    }
  </style>
</head>

<div class="container">
  <div class="box">
    <h1>Boa Entrega</h1>
    <div>
      <h3>Olá {{$data->user->name}}!</h3>
      <p>Segue prévia do relatório diário dos transportes de mercadorias/objetos da <b>Boa Entrega</b> realizadas na data de <b>{{Carbon::createFromFormat('Y-m-d',$data->date)->format('d/m/Y')}}</b></p>

      <div class="form-row"><label>Total geral: </label>
        <div class="input-form">{{$data->total}}</div>
      </div>

      <div class="form-row"><label>Entregas concluídas: </label>
        <div class="input-form">{{$data->total_delivered}}</div>
      </div>

      <div class="form-row"><label>Atrasadas: </label>
        <div class="input-form">{{$data->total_delayed}}</div>
      </div>

      <div class="form-row"><label>Em transporte: </label>
        <div class="input-form">{{$data->total_in_transport}}</div>
      </div>

      <div class="form-row"><label>Aguardando despacho: </label>
        <div class="input-form">{{$data->total_awaiting_dispatch}}</div>
      </div>

      <br>
      <p>É possivel acessar um relatório detalhado acessando esta <b><a href="{{env('APP_URL_FRONT') . 'report?report_id=' . $data->report_id}}">página</a></b></p>
    </div>
  </div>
</div>
</body>

</html>