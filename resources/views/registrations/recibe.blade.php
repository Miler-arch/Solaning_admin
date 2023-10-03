<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .receipt-container {
            width: 650px;
            margin: 0 auto;
            text-align: center;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
        }
        .detail-containter{
            width: 636px;
            margin-left: -15px;
            text-align: center;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
        }
        .logo {
            width: 80px;
            margin-bottom: 10px;
        }
        .header {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: 900;
        }

        .details {
            margin-bottom: 20px;
        }
        .item {
            text-align: left;
            margin-bottom: 5px;
        }
        .total {
            font-weight: bold;
        }
        .text-red {
            color: red;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        {{-- <img src="{{ public_path() . '/img/logo.png' }}" width="180" height="180"> --}}
        <div class="header">RECIBO DE PAGO</div>
        <div class="details">
            <div class="d-flex">
                <div class="row">
                    <div class="col-11">
                        <div class="item"><b>Empresa:</b> SOLANING S.R.L.</div><span class="float-right"><b>RECIBO N°:</b> <b class="text-red">{{$data->id}}</b></span>
                        <div class="item"><b>NIT:</b> 298436024</div>   <span class="float-right"><b>POR: {{"Bs. ". number_format($data->mount, 2, '.', ',')}}</b></span>
                        <div class="item"><b>Dirección:</b> Calle Venezuela Nro 780, zona central Cbba.</div>
                        <div class="item"><b>Teléfono:</b> 4052061 - 63058452</div>
                        <div class="item"><b>E-mail:</b> solaning.info@gmail.com</div>
                        <div class="item">www.solaningcapacitacion.com</div>
                    </div>


                </div>
            </div>
            <div class="detail-containter">
                <div class="item">RECIBO DEL SR.(A): {{$data->client->name}} {{$data->client->lastname}}({{$data->client->ci}})........LA CANTIDAD DE: <b>{{"Bs. ". number_format($data->mount, 2, '.', ',')}}</b>.......................................................</div>
                <div class="item">CANTIDAD EN LETRAS: .................................................................................................</div>
                <div class="item">POR CONCEPTO DE: {{$data->concept}}...................INICIO:{{$data->start_date}}..............................</div>
                <div class="item">A CUENTA: <b>{{"Bs. ". number_format($data->mount, 2, '.', ',')}}</b>........ SALDO:..<b>{{ $data->course->price - $data->mount }}</b>..................TOTAL:....<b>{{$data->course->price}}</b>.....................</div>
            </div>
        </div>
    </div>
</body>
</html>
