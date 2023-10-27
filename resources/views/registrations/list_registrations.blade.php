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
                        <th>Versión</th>
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
                            @if ($registration->method_payment == '1')
                                <span class="badge-success rounded p-1 font-weight-bold">Completo
                                    <span class="fa fa-check-circle"></span>
                                </span>
                            @else
                                <span class="badge-warning rounded p-1 font-weight-bold">Parcial
                                    <span class="fa fa-exclamation-circle"></span>
                                </span>
                            @endif
                        </td>
                        <td>{{ $registration->course->version }}</td>
                        <td>{{ $registration->course->start_date }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-xs btn-default text-primary shadow" data-toggle="modal" data-target="#registrationModal{{ $registration->id }}" title="Ver">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <a href="{{ route('registrations.edit', $registration) }}" class="btn btn-xs btn-default text-cyan shadow" title="Editar">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>

                                <a href="{{ route('list_registrations.pdf', $registration) }}" target="_blank" class="btn btn-xs btn-default text-dark shadow" title="Descargar PDF">
                                    <i class="fa fa-fw fa-print"></i>
                                </a>
                            </div>
                            <div class="modal fade" id="registrationModal{{ $registration->id }}" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="registrationModalLabel">Detalles del Registro</h5>
                                            <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive mb-4">
                                                <table class="table table-bordered">
                                                    <thead class="table-primary text-white">
                                                        <tr>
                                                            <th>Descuento</th>
                                                            <th>Pago</th>
                                                            <th>Debe</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="table-light">
                                                            <td scope="row">{{$registration->discount." %"}}</td>
                                                            <td>{{ $registration->mount." Bs."}}</td>
                                                            <td>
                                                                @if ($registration->discounted_price - $registration->mount > 0)
                                                                    <span class="bg-warning rounded p-1 font-weight-bold">{{ $registration->discounted_price - $registration->mount." Bs." }}</span>
                                                                @elseif ($registration->discounted_price - $registration->mount == 0)
                                                                    <span class="bg-primary rounded p-1 font-weight-bold">{{ $registration->discounted_price - $registration->mount." Bs." }}</span>
                                                                @elseif ($registration->course->price - $registration->mount > 0)
                                                                    <span class="bg-warning rounded p-1 font-weight-bold">{{ $registration->course->price - $registration->mount." Bs." }}</span>
                                                                @elseif ($registration->course->price - $registration->mount == 0)
                                                                    <span class="bg-primary rounded p-1 font-weight-bold">{{ $registration->course->price - $registration->mount." Bs."  }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($registration->discounted_price > 0)
                                                                    <span class="badge-success rounded p-1 font-weight-bold">{{ $registration->discounted_price. " Bs." }}</span>
                                                                @else
                                                                    <span class="badge-success rounded p-1 font-weight-bold">{{ $registration->course->price. " Bs." }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="mb-3">
                                                    <label class="fw-bold">NIT:</label>
                                                    <span>{{ $registration->nit }}</span>
                                                </div>
                                                <div>
                                                    <label class="fw-bold">Razón Social:</label>
                                                    <span>{{ $registration->business_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

