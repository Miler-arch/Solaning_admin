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
                        <a class="btn btn-sm mr-1 btn-default text-primary shadow" data-toggle="modal" data-target="#registrationModal{{ $registration->id }}" title="Ver">
                            <i class="fa fa-fw fa-eye"></i>
                        </a>
                        <a class="btn btn-sm mr-1 btn-default text-cyan shadow" data-toggle="modal" data-target="#updateModal{{ $registration->id }}" title="Actualizar Pago">
                            <i class="fas fa-money-check-alt"></i>
                        </a>
                        <a class="btn btn-sm mr-1 btn-default text-warning shadow" data-toggle="modal" data-target="#pdfModal{{ $registration->id }}" title="Descargar PDF's">
                            <img src="{{asset('img/folder.ico')}}" style="width:20px; height:20px">
                        </a>
                    </div>

                    <div class="modal fade" id="pdfModal{{ $registration->id }}" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h5 class="modal-title text-bold" id="registrationModalLabel">LISTADO DE PAGOS</h5>
                                    <button type="button" class="bg-danger rounded border-0 px-3 py-2" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $counter = 1;
                                    @endphp
                                    <div class="mb-3">
                                        <a href="{{ route('list_registrations.pdf', $registration) }}" target="_blank" class="btn btn-primary" title="Descargar PDF's">
                                            <i class="fa fa-fw fa-file-pdf"></i> <b>PAGO NÚMERO: {{ $counter++ }}</b> | {{ $registration->created_at->format('d-m-Y-H-i-s') }}
                                        </a>
                                    </div>
                                    <hr>
                                    @foreach($registration->registrationes as $pdfFile)
                                        @if ($pdfFile->file_path)
                                            <div class="mb-3">
                                                <a href="{{ asset('storage/pdfs/' . $registration->id . '/' . $pdfFile->file_path) }}" target="_blank" class="btn btn-warning">
                                                    <i class="fa fa-fw fa-file-pdf"></i> <b>PAGO NÚMERO: {{ $counter++ }}</b> | {{ basename($pdfFile->file_path) }}
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="registrationModal{{ $registration->id }}" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h5 class="modal-title text-bold" id="registrationModalLabel">DETALLES DEL REGISTRO</h5>
                                    <button type="button" class="bg-danger rounded border-0 px-3 py-2" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6><b>CURSO:</b> <span class="text-info">{{ $registration->course->name }}</span>  | <b>VERSIÓN:</b> <span class="text-info">{{ $registration->course->version }}</span></h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pago</th>
                                                    <th>Debe</th>
                                                    <th>Descuento</th>
                                                    <th>Total a Pagar</th>
                                                    <th>Fecha / Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="text-bold">
                                                    <td>1</td>
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
                                                    <td scope="row">{{$registration->discount." %"}}</td>

                                                    <td>
                                                        @if($registration->discounted_price > 0)
                                                            <span class="badge-success rounded p-1 font-weight-bold">{{ $registration->discounted_price. " Bs." }}</span>
                                                        @else
                                                            <span class="badge-success rounded p-1 font-weight-bold">{{ $registration->course->price. " Bs." }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $registration->created_at->format('d-m-Y H:i:s A') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <h4 class="text-bold text-center bg-dark">HISTORIAL DE PAGOS PARCIALES</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pago</th>
                                                    <th>Fecha / Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $counter = 1;
                                                @endphp
                                                @if($registration->registrationes->count() > 0)
                                                    @foreach($registration->registrationes as $index => $payment)
                                                        @if ($payment->mount_update && $payment->date_update)
                                                            <tr class="text-bold">
                                                                <td>{{ $counter++ }}</td>
                                                                <td>{{ $payment->mount_update . " Bs." }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($payment->date_update)->format('d-m-Y H:i:s A') }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3" class="text-center text-bold">No hay pagos parciales.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning text-bold" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="updateModal{{ $registration->id }}" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="registrationModalLabel">Pago Parcial</h5>
                                    <button type="button" class="bg-danger rounded border-0 px-3 py-2" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('registrations.update', $registration->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="hidden" name="user_id">

                                            <label for="updated_amount">Monto a pagar :</label>
                                            <input type="number" class="form-control" id="updated_amount" name="updated_amount" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning text-bold" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary text-bold">Pagar</button>
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
