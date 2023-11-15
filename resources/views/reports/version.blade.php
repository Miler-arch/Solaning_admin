<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Por Versiones de Curso</title>
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
    </style>
</head>
<body>
    <div class="text-center">
        <h2>REPORTE POR VERSIONES DE CURSO</h2>
    </div>
<div>
    <table class="table table-bordered ">
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

    @foreach ($clients as $client)
        <h2>{{ $client->name }}</h2>
        <p>Enrolled Courses:</p>
        <ul>
            @foreach ($detailRegisters->where('client_id', $client->id) as $detailRegister)
                <li>{{ $detailRegister->course->name }} - {{ $detailRegister->course->version }}</li>
            @endforeach
        </ul>
        <hr>
    @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
