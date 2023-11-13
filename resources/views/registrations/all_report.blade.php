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

        th {
            background-color: #343a40; /* Bootstrap dark background color */
            color: #fff; /* Bootstrap light text color */
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternate row background color */
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h2 class="bg-dark text-white">REPORTE GENERAL</h2>
    </div>
    <div>
        <table class="table table-bordered table-striped">
            <thead>
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
                    <th scope="col">MONTO A PAGAR</th>
                    <th scope="col">1er P</th>
                    <th scope="col">2do P</th>
                    <th scope="col">3er P</th>
                    <th scope="col">TOTAL PAGADO</th>
                </tr>
            </thead>
            <tbody>
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
                        <td>{{ $report->mount}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
