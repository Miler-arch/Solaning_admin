@extends('adminlte::page')

@section('title', 'Reportes')

@section('plugins.Datatables', true)
@section('plugins.Select2', true)

@section('content')
<div class="mt-3 p-3 rounded align-items-center contenedor-header">
    <span class="font-weight-bold titulo-header">Reportes</span>
    <div class="mt-3">
        <form action="{{ route('report.pdf') }}" method="GET">
            @csrf
            <div class="d-flex flex-wrap justify-content-center">
                <div class="mx-2 mt-1">
                    <select class="js-example-basic-single js-states form-control js-courses_id" id="validationCustom02" name="course_id" required>
                        <option value="" disabled selected>Selecciona una versión</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->version }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-1">
                    <button type="submit" class="btn btn-primary">CONSULTAR</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="mt-3">
    <table id="datatable" class="table responsive nowrap" style="width:100%">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nombre</th>
                <th>Versión</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $index => $report)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$report->client->name}}</td>
                <td>{{$report->client->lastname}}</td>
                <td>{{$report->course->name}}</td>
                <td>{{$report->course->version}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
@section('js')
<script>
    $(document).ready(function() {
        $('.js-courses_id').select2({
            placeholder: "Seleccione un versión",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@stop
