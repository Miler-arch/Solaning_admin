<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Por Versiones de Curso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
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
    </style>
</head>
<body>
    <div class="text-center">
        <h2>CURSO - {{ $selectedCourse->name ?? 'TODOS LOS CURSOS' }} (VERSIÓN: {{ $selectedCourse->version ?? 'N/A' }})</h2>
    </div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">APELLIDOS</th>
                    <th scope="col">NOMBRES</th>
                    <th scope="col">NOMBRE DEL CURSO</th>
                    <th scope="col">VERSIÓN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @forelse ($clients as $client)
                    @forelse ($detailRegisters->where('client_id', $client->id) as $detailRegister)
                        <tr>
                            <th scope="row">{{ $counter++ }}</th>
                            <td>{{ $client->lastname }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $detailRegister->course->name }}</td>
                            <td>{{ $detailRegister->course->version }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay registros disponibles</td>
                        </tr>
                    @endforelse
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay clientes disponibles</td>
                        </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
