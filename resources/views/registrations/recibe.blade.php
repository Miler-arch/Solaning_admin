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
            color: #002c66
        }
        .receipt-container {
            width: 650px;
            margin: 0 auto;
            text-align: center;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
        }
        .detail-containter {
            width: 636px;
            margin-left: -15px;
            text-align: center;
            border: 2px solid #333;
            padding: 10px;
            border-radius: 10px;
            margin-top: -40px;
        }
        .detail-containter div {
            line-height: 2.1;
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
            font-size: .6rem;
            line-height: 1.1;
        }
        .total {
            font-weight: bold;
        }
        .text-red {
            color: red;
        }
        img {
            display: inline-block !important;
            position: absolute !important;
            top: 0;
        }
        .contenedor-1 {
            position: absolute;
            left: 15%;
            top: 2%;
        }
        .numeros-1 {
            position: absolute;
            left: 63%;
            top: 1%;
        }
        .numeros-2 {
            position: absolute;
            left: 72%;
            top: 4%;
        }
        .espaciado {
            margin-bottom: 10rem;
        }

        .contenedor-firmas {
            margin-top: 3rem;
        }
        .linea {
            width: 100%;
            border-bottom: 1px;
            border-bottom-color: #002c66;
            border-style: solid;
        }
        .firma-1 {
            position: absolute;
            left: 15%;
        }
        .firma-2 {
            position: absolute;
            left: 60%;
        }
        .firmas {
            font-size: .7rem;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="d-block">
            <div class="header">RECIBO DE PAGO</div>
            <img src="{{ public_path() . '/img/logo-letras.png' }}" width="200" height="90">
        </div>
        <div class="details">
            <div class="d-flex">
                <div class="row">
                    <div class="col-11">
                        <div class="espaciado"></div>
                        <div class="contenedor-1">
                            <div class="item"><b>Empresa:</b> SOLANING S.R.L.</div>
                            <div class="item"><b>NIT:</b> 298436024</div>
                            <div class="item"><b>Dirección:</b> Calle Venezuela Nro 780, zona central Cbba.</div>
                            <div class="item"><b>Teléfono:</b> 4052061 - 63058452</div>
                            <div class="item"><b>E-mail:</b> solaning.info@gmail.com</div>
                            <div class="item">www.solaningcapacitacion.com</div>
                        </div>

                        <div class="contenedor-2">
                            <span class=" numeros-1"><b>RECIBO N°</b> <b class="text-red border border-secondary p-1 px-5">{{$formattedId }}</b></span>
                            <span class=" numeros-2"><b>POR: <span class="border border-secondary p-1 px-4">{{"Bs. ". number_format($data->mount, 2, '.', ',')}}</span></b></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-containter">
                <div class="item text-uppercase"><b>RECIBO DEL SR.(A):</b> {{$data->client->name}} {{$data->client->lastname}}({{$data->client->ci}})  <span class="float-right">LA CANTIDAD DE: <b class="px-3">{{"Bs. ". number_format($data->mount, 2, '.', ',')}}</b> </span></div>
                <div class="item text-uppercase"><b>CANTIDAD EN LETRAS:</b></div>
                <div class="item text-uppercase"><b>POR CONCEPTO DE:</b> PAGO POR INSCRIPCIÓN DEL CURSO: <b>{{$data->course->name}}</b> DEL ESTUDIANTE:
                    <b>{{$data->client->name}} {{$data->client->lastname}}</b> DE LA VERSIÓN: <b>{{$data->course->version}}</b></div>
                <div class="item"><b>INICIO: </b>{{$data->start_date}}</div>
                <div class="item text-center">
                    <span class="mx-3"><b>A CUENTA:</b>{{"Bs. ". number_format($data->mount, 2, '.', ',')}}</span>
                    <span class="mx-3"><b>SALDO:</b>{{"Bs. ".$discountRegistration - $data->mount }}</span>
                    <span class="mx-3"><b>DESCUENTO:</b>{{ $data->discount."%" }}</span>
                    <span class="mx-3"><b>TOTAL:</b> {{"Bs. ". $discountRegistration }}</span>
                </div>
            </div>
            <div class="item mt-2"><span><b>LUGAR Y FECHA:</b></span> <span><b>Cochabamba, {{ $data->created_at->format("d/m/Y") }}</b></span></div>
            <div class="contenedor-firmas">
                    <div class="w-25 firma-1">
                        <div class="linea"></div>
                        <span class="firmas"><b>RECIBÍ CONFORME</b></span>
                    </div>

                    <div class="w-25 firma-2">
                        <div class="linea"></div>
                        <span class="firmas"><b>ENTREGUÉ CONFORME</b></span>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>
