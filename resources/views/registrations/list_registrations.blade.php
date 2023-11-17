@extends('adminlte::page')

@section('title', 'Lista de inscripciones')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Lista de Inscritos</span>
    <a href="{{ route('all_report.pdf') }}" target="_blank" class="btn btn-primary btn-sm p-2 shadow float-right">
        <i class="fa fa-fw fa-file-pdf"></i> <b>VER REPORTE GENERAL</b>
    </a>
    <a href="{{ route('export_excel') }}" class="btn btn-success btn-sm p-2 shadow float-right mr-2">
        <i class="fa fa-fw fa-file-excel"></i> <b>EXPORTAR EXCEL</b>
    </a>
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
                        <a class="btn btn-sm mr-1 btn-default text-cyan shadow" data-toggle="modal" data-target="#registrationModal{{ $registration->id }}" title="Ver">
                            <i style='font-size:20px' class='fas'>&#xf15c;</i>
                        </a>
                        <a class="btn btn-sm mr-1 btn-default text-primary shadow" data-toggle="modal" data-target="#updateModal{{ $registration->id }}" title="Actualizar Pago">
                            <i style='font-size:15px' class="fas fa-money-check-alt"></i>
                        </a>
                        <a class="btn btn-sm mr-1 btn-default text-warning shadow" data-toggle="modal" data-target="#pdfModal{{ $registration->id }}" title="Descargar PDF's">
                            <img src="{{asset('img/folder.ico')}}" style="width:20px; height:20px">
                        </a>
                    </div>

                    <div class="modal fade" id="pdfModal{{ $registration->id }}" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-modal">
                                    <h5 class="modal-title" id="registrationModalLabel">LISTADO DE PAGOS</h5>
                                    <button type="button" class="border-0 rounded-sm header-modal" data-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
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
                                <div class="modal-header bg-modal">
                                    <h5 class="modal-title" id="registrationModalLabel">DETALLES DEL REGISTRO</h5>
                                    <button type="button" class="border-0 rounded-sm header-modal" data-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="titulo-curso"><b>CURSO:</b> {{ $registration->course->name }}  | <b>VERSIÓN:</b> {{ $registration->course->version }}</h6>
                                    <div class="table-responsive mt-3">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pago</th>
                                                    <th>Debe</th>
                                                    <th>Descuento</th>
                                                    <th>Total a Pagar</th>
                                                    <th>Fecha / Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-weight-normal">
                                                <tr>
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
                                    <h5 class="text-bold p-2 d-block text-center titulo-curso">HISTORIAL DE PAGOS PARCIALES</h5>
                                   <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Monto Inicial</th>
                                                    <th>Tipo de Pago</th>
                                                    <th>Fecha / Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-weight-normal">
                                                @php
                                                    $counter = 1;
                                                    $foundInitialAmount = false;
                                                @endphp
                                                @if($registration->registrationes->count() > 0)
                                                    @foreach($registration->registrationes as $index => $payment)
                                                        @if ($payment->mount_inicial && !$foundInitialAmount && $payment->date_start && $payment->type_payment_inicial)
                                                            <tr>
                                                                <td>{{ $counter++ }}</td>
                                                                <td>{{ $payment->mount_inicial . " Bs." }}</td>
                                                                <td>{{ $payment->type_payment_inicial }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($payment->date_start)->format('d-m-Y H:i:s A') }}</td>
                                                            </tr>
                                                            @php
                                                                $foundInitialAmount = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center text-bold text-secondary">No hay pagos parciales</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pago</th>
                                                    <th>Tipo de Pago</th>
                                                    <th>Fecha / Hora</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-weight-normal">
                                                @php
                                                    $counter = 2;
                                                @endphp
                                                @if($registration->registrationes->count() > 0)
                                                    @foreach($registration->registrationes as $index => $payment)
                                                        @if ($payment->mount_update && $payment->date_update && $payment->updated_type_payment)
                                                            <tr>
                                                                <td>{{ $counter++ }}</td>
                                                                <td>{{ $payment->mount_update . " Bs." }}</td>
                                                                <td>{{ $payment->updated_type_payment }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($payment->date_update)->format('d-m-Y H:i:s A') }}</td>
                                                                <td>
                                                                    <form action="{{route('registrations.destroy', $registration)}}" method="POST" class="form-eliminar">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <input type="hidden" name="registration_id" value="{{ $registration->id }}">
                                                                        <input type="hidden" name="mount_update" value="{{ $payment->mount_update }}">
                                                                        <input type="hidden" name="date_update" value="{{ $payment->date_update }}">
                                                                        <button type="submit" class="btn btn-outline-danger btn-sm text-bold rounded-circle" title="Eliminar Pago">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center text-bold text-secondary">No hay pagos parciales.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <label class="font-weight-bolder">NIT:</label>
                                        <span>{{ $registration->nit }}</span>
                                    </div>
                                    <div>
                                        <label class="font-weight-bolder">Razón Social:</label>
                                        <span>{{ $registration->business_name }}</span>
                                    </div>
                                    <div>
                                        <label class="font-weight-bolder">Método de Pago:</label>
                                        <span>{{ $registration->type_payment }}</span>
                                    </div>
                                </div>
                               <!--  <div class="modal-footer">
                                    <button type="button" class="btn btn-warning text-bold" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="updateModal{{ $registration->id }}" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-modal text-white">
                                    <h5 class="modal-title" id="registrationModalLabel">Pago Parcial</h5>
                                    <button type="button" class="border-0 rounded-sm header-modal" data-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('registrations.update', $registration->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="hidden" name="user_id">
                                                <label for="updated_amount" class="font-weight-bold">Monto a pagar :</label>
                                                <input type="text" class="form-control" id="updated_amount" name="updated_amount" min="0" step="0.01" required>
                                            </div>
                                            <div class="col-6">
                                                <label  class="font-weight-bold">Tipo de Pago :</label>
                                                <select class="form-control" name="updated_type_payment" required>
                                                    <option selected disabled value="">-- Seleccione el tipo de pago --</option>
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                    <option value="Depósito Bancario">Depósito Bancario</option>
                                                    <option value="QR">QR</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary text-bold" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Atrás</button>
                                            <button type="submit" class="btn btn-primary text-bold"><i class="fas fa-money-bill"></i> Pagar</button>
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
@section('js')
<script>
    $('.form-eliminar').submit(function(e){
        e.preventDefault();

            Swal.fire({
            title: '¿Está seguro?',
            text: "El pago se eliminara definitivamente.",
            icon: 'warning',
            customClass: {
                 icon: "no-before-icon",
             },
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                this.submit();
            }
        })
    });
</script>
@stop
