@extends('adminlte::page')

@section('title', 'Lista de inscripciones')

@section('plugins.Datatables', true)

@section('content')
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Lista de Inscritos</span>
</div>
<div class="mt-3">
    <table id="datatable" class="table responsive nowrap" style="width:100%">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Acciones</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Estado de pago</th>
                <th>Fecha de inicio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrationsList as $index => $registration)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm mr-1 btn-default text-primary shadow" data-toggle="modal" data-target="#registrationModal{{ $registration->id }}" title="Ver">
                            <i class="fa fa-fw fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm mr-1 btn-default text-cyan shadow" data-toggle="modal" data-target="#updateModal{{ $registration->id }}" title="Actualizar Pago">
                            <i class="fa fa-fw fa-edit"></i>
                        </a>
                        <a href="{{ route('list_registrations.pdf', $registration) }}" target="_blank" class="btn btn-sm btn-default text-dark shadow" title="Descargar PDF">
                            <i class="fa fa-fw fa-print"></i>
                        </a>
                    </div>

                    <div class="modal fade" id="registrationModal{{ $registration->id }}" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="registrationModalLabel">{{ $registration->course->name }} | {{ $registration->course->version }}</h5>
                                    <button type="button" class="bg-danger rounded border-0 px-3 py-2" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Descuento</th>
                                                    <th>Pago</th>
                                                    <th>Debe</th>
                                                    <th>Total</th>
                                                    <th>Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
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
                                                    <td>{{ $registration->created_at }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div>
                                            <label class="fw-bold">NIT:</label>
                                            <span>{{ $registration->nit }}</span>
                                        </div>
                                        <div>
                                            <label class="fw-bold">Razón Social:</label>
                                            <span>{{ $registration->business_name }}</span>
                                        </div>
                                        <div>
                                            <label class="fw-bold">Método de Pago:</label>
                                            <span>{{ $registration->type_payment }}</span>
                                        </div>
                                    </div>

                                    <!-- Historial de Pagos -->
                                    <h6 class="mt-3">Historial de Pagos</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Monto Acumulado</th>
                                                    <th>Fecha de Actualización</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $accumulatedAmount = 0;
                                                @endphp
                                                @foreach($registration->registrationes as $payment)
                                                    <tr>
                                                        @php
                                                            $accumulatedAmount += $payment->mount_update;
                                                        @endphp
                                                        <td>{{ $accumulatedAmount . " Bs." }}</td>
                                                        <td>{{ $payment->date_update }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="updateModal{{ $registration->id }}" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="registrationModalLabel">Actualizar Pago</h5>
                                    <button type="button" class="bg-danger rounded border-0 px-3 py-2" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('registrations.update', $registration->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="updatedAmount">Nuevo Monto:</label>
                                            <input type="number" class="form-control" id="updatedAmount" name="updated_amount" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Actualizar Pago</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>{{ $registration->user->name }}</td>
                <td>{{ $registration->client->name }}</td>
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
                <td>{{ $registration->course->start_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
