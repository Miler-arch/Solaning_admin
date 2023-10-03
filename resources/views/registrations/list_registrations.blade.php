@extends('adminlte::page')

@section('title', 'Lista de inscripciones')

@section('plugins.Datatables', true)

@section('content')
<div class="card mt-2">
        <div class="card-body">
            <table id="datatable" class="table table-striped display responsive nowrap" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Cliente</th>
                        <th>Curso</th>
                        <th>Razón Social</th>
                        <th>Concepto</th>
                        <th>NIT</th>
                        <th>Monto</th>
                        <th>Tiempo de inicio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrationsList as $index => $registration)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $registration->user->name }}</td>
                        <td>{{ $registration->client->name }}</td>
                        <td>{{ $registration->course->name }}</td>
                        <td>{{ $registration->business_name }}</td>
                        <td>{{ $registration->concept }}</td>
                        <td>{{ $registration->nit }}</td>
                        <td>{{ $registration->mount }}</td>
                        <td>{{ $registration->start_date }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('registrations.show', $registration) }}" class="btn btn-xs btn-default text-primary shadow" title="Ver">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                {{-- <a href="{{ route('registrations.recibe', $registration) }}" class="btn btn-xs btn-default text-danger shadow" title="PDF">
                                    <i class="fa fa-fw fa-file-pdf"></i>
                                </a> --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

