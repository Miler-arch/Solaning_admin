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
            /* width: 680px; */
            /* margin-left: -1.5%; */
            margin: 0 auto;
            text-align: center;
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
        }
        .detail-containter {
            width: 636px;
            /* width: 665px; */
            margin-left: -5px;
            text-align: center;
            border: 2px solid #333;
            padding: 10px;
            border-radius: 10px;
            margin-top: -11%;
        }
        .detail-containter div {
            line-height: 2.1;
            font-size: 0.8rem
        }
        .logo {
            width: 80px;
            margin-bottom: 10px;
        }
        .header {
            font-size: 2rem;
            margin-top: -0.2rem;
            margin-bottom: 15px;
            font-weight: 900;
            text-decoration: underline;
        }

        .details {
            margin-bottom: 20px;
        }
        .item {
            text-align: left;
            margin-bottom: 5px;
            font-size: .7rem;
            line-height: 0.7;
        }
        .item-2 {
            text-align: left;
            margin-bottom: 10px;
            font-size: .7rem;
            line-height: 1.3 !important;
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
            left: 12%;
            top: 0;
            margin-top: 4px;
        }
        .numeros-1 {
            position: absolute;
            left: 64.5%;
            top: 1%;
        }
        .numeros-2 {
            position: absolute;
            left: 70%;
            top: 4%;
        }
        .espaciado {
            margin-bottom: 10rem;
        }

        .contenedor-firmas {
            margin-top: 5rem;
        }
        .linea {
            width: 100%;
            border-top: 1px solid #002c66;

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
        .dato {
            font-style: italic;
            border-bottom: 2px dotted #002c66;
        }
        .dato-f {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="d-block">
            <div class="header">RECIBO DE PAGO</div>
            <img src="{{ public_path() . '/img/logo-letras.png' }}" width="160" height="70" class="mt-4">
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
                            <span class=" numeros-1"><b>RECIBO N°</b> <b class="text-red border border-secondary p-1 px-5">{{ $formattedId }}</b></span>
                            <span class="numeros-2"><b>POR: <span class="border border-secondary p-1 px-4">{{"Bs. ". number_format($montoActualizado, 2, ',', '.')}}</span></b></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-containter">
                <table>
                    <tr>
                        <td class="w-25">
                            <div class="item-2 text-uppercase">
                               <b>RECIBO DEL SR.(A): </b>
                            </div>
                        </td>
                        <td class="w-50">
                            <div class="item-2 text-uppercase">
                                <span class="dato">{{$data->client->name}} {{$data->client->lastname}}</span>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="item-2 text-uppercase" style="margin-left: -50px !important">
                               <b>LA CANTIDAD DE:</b> &nbsp; <span class="px-3"><span class="dato">{{"Bs. ". number_format($montoActualizado, 2, ',', '.')}}</span></span></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="item-2 text-uppercase"><b>CANTIDAD EN LETRAS:</b></div>
                        </td>
                        <td colspan="3">
                            <div class="item-2 text-uppercase">
                                <span class="dato">{{$montoEnPalabrasString}} 00/100 BOLIVIANOS</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="item-2 text-uppercase"><b>POR CONCEPTO DE:</b></div>
                        </td>
                        <td colspan="5" class="w-100">
                            <div class="item-2 text-uppercase">
                                <span class="dato">PAGO POR INSCRIPCIÓN DEL CURSO <b>{{$data->course->name}}</b> DEL ESTUDIANTE <b>{{$data->client->name}} {{$data->client->lastname}}</b>   DE LA VERSIÓN <b>{{$data->course->version}}</b>  </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="item-2"><b>TIPO DE PAGO: </b></div>
                        </td>
                        <td>
                            <div class="item-2 text-uppercase">
                                <span class="dato text-uppercase">
                                    {{ $typePayment }}
                                </span>
                            </div>
                        </td>

                        <td colspan="4">
                            <div class="item-2 text-uppercase" style="margin-left: -60px !important">
                                <b>INICIO DEL CURSO: </b>
                                <span class="dato">
                                    {{ \Carbon\Carbon::parse($data->course->start_date)->format('j-M-Y') }}
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>

                    </tr>
                </table>

                <div class="item-2 text-center mt-3">
                    <span class="mx-3"><b>A CUENTA:</b> <span class="dato">{{"Bs. ". number_format($montoActualizado, 2, ',', '.')}}<</span></span>&nbsp;&nbsp;
                    <span class="mx-3"><b>SALDO:</b> <span class="dato">{{"Bs. ". number_format($data->discounted_price - $data->mount, 2, ',', '.') }}</span></span>&nbsp;&nbsp;
                    <span class="mx-3"><b>DESCUENTO:</b> <span class="dato">{{ $data->discount."%" }}</span></span>&nbsp;&nbsp;
                    <span class="mx-3"><b>TOTAL:</b> <span class="dato">{{"Bs. ". number_format($data->discounted_price, 2, ',', '.') }}</span></span>
                </div>
            </div>

            <div class="item-2 mt-2 float-left"><span><b>LUGAR Y FECHA:</b></span> <span class="dato-f"><b>Cochabamba, {{ $data->created_at->format("d/m/Y") }}</b></span></div>
            <div class="item-2 mt-2 float-right"><span><b>EMITIDO POR:</b></span> <span class="dato-f text-uppercase"><b>{{Auth::user()->name}}</b></span></div>
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
