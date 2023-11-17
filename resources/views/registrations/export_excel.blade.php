<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte General</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: center;
        }

        .titulo {
            font-weight: bold;
            font-size: 2rem !important;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <p class="titulo">REPORTE GENERAL</p>
    </div>
<div>
    <table class="table table-bordered ">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">N° DE CI</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">NOMBRES</th>
                <th scope="col">CELULAR</th>
                <th scope="col">CORREO ELECTRÓNICO</th>
                <th scope="col">CIUDAD</th>
                <th scope="col">FECHA NAC.</th>
                <th scope="col">FORMACIÓN</th>
                <th scope="col">MONTO PAGAR</th>
                <th scope="col">1er P</th>
                <th scope="col">2do P</th>
                <th scope="col">3er P</th>
                <th scope="col">4to P</th>
                <th>TOTAL PAGADO</th>

            </tr>
        </thead>
        <tbody>
            @php
                $totalDiscountedPrice = 0;
                $totalPaid = 0;
            @endphp
            @foreach($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->client->ci }}</td>
                    <td>{{ $report->client->lastname }}</td>
                    <td>{{ $report->client->name }}</td>
                    <td>{{ $report->client->phone }}</td>
                    <td>{{ $report->client->email }}</td>
                    <td>{{ $report->client->city }}</td>
                    <td>{{ $report->client->birthdate }}</td>
                    <td>{{ $report->client->training }}</td>
                    <td>{{ $report->discounted_price }}</td>
                    <td>{{ $report->mount_initial }}</td>

                    @php
                        $totalDiscountedPrice += $report->discounted_price;
                        $processedMountUpdates = [];
                    @endphp

                    @foreach($report->registrationes as $payment)
                        @if (isset($payment->mount_update))
                            @php
                                $processedMountUpdates[] = $payment->mount_update;
                            @endphp
                        @endif
                    @endforeach

                    <td>{{ isset($processedMountUpdates[0]) ? $processedMountUpdates[0] : '' }}</td>
                    <td>{{ isset($processedMountUpdates[1]) ? $processedMountUpdates[1] : '' }}</td>
                    <td>{{ isset($processedMountUpdates[2]) ? $processedMountUpdates[2] : '' }}</td>
                    <td>
                        {{ number_format($report->mount_initial + array_sum($processedMountUpdates), 2, ',', '.') }}
                    </td>
                    @php
                        $totalPaid += $report->mount_initial + array_sum($processedMountUpdates);
                    @endphp
                </tr>
            @endforeach
                <tr>
                    <td colspan="9"></td>
                    <td class="text-right">{{ number_format($totalDiscountedPrice, 2, ',', '.') }}</td>
                    <td colspan="4"></td>
                    <td colspan="1" class="text-right">{{ number_format($totalPaid, 2, ',', '.') }}</td>
                </tr>
        </tbody>
    </table>

</div>
</body>
</html>
