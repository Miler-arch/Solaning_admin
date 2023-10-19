@extends('adminlte::page')

@section('title', 'Lista de inscripciones')

@section('plugins.Datatables', true)

@section('content')
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Lista de Inscritos</span>
</div>
<div class="mt-4">
        <div class="text-secondary">
            <table id="datatable" class="table responsive nowrap" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Cliente</th>
                        <th>Curso</th>
                        <th>Método de pago</th>
                        <th>Razón Social</th>
                        <th>Concepto</th>
                        <th>NIT</th>
                        <th>Pago</th>
                        <th>Debe</th>
                        <th>Total</th>
                        <th>Fecha de inicio</th>
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
                        <td>
                            @if ($registration->method_payment == "completo")
                                <span class="badge-success rounded p-1">Completo
                                    <span class="fa fa-check-circle"></span>
                                </span>
                            @else
                                <span class="badge-warning rounded p-1">Parcial
                                    <span class="fa fa-exclamation-circle"></span>
                                </span>
                            @endif
                        </td>
                        <td>{{ $registration->business_name }}</td>
                        <td>{{ $registration->concept }}</td>
                        <td>{{ $registration->nit }}</td>
                        <td>{{ $registration->mount }}</td>
                        <td>
                            @if ($registration->course->price - $registration->mount > 0)
                                <span class="bg-warning rounded p-1 px-2 font-weight-bold">{{ $registration->course->price - $registration->mount }}</span>
                            @elseif ($registration->course->price - $registration->mount == 0)
                                <span class="bg-primary rounded py-1 px-3 font-weight-bold">{{ $registration->course->price - $registration->mount }}</span>
                            @endif
                        </td>
                        <td>{{ $registration->course->price }}</td>
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

