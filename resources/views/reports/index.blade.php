@extends('adminlte::page')

@section('title', 'Reportes')

@section('plugins.Datatables', true)

@section('content')
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Reportes</span>
</div>
<div class="mt-3">
    <table id="datatable" class="table responsive nowrap" style="width:100%">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Acciones</th>
                <th>Estado</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $index => $report)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$report->client->name}}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop


