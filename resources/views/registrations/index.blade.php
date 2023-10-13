@extends('adminlte::page')

@section('title', 'Registrations')
@section('plugins.Select2', true)
@section('plugins.Datatables', true)

@section('content')
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Inscripciones</span>
</div>
<div class="contenedor-inscripciones mt-3">
    <div class="card mt-4">
        <div class="card-body contenedor-card">
            <form action="{{route('registrations.store')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="col-12 d-flex flex-wrap justify-content-evenly">
                        <div class="col-md-6 mb-4">
                            <label for="validationCustom01">Estudiante :</label>
                            <select class="js-example-basic-single js-states form-control" id="validationCustom01" name="client_id" required>
                                @foreach ($clients as $client)
                                    <option></option>
                                    <option value="{{ $client->id }}">{{ $client->name }} | {{ $client->ci }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un estudiante.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02">Cursos :</label>
                            <select class="js-example-basic-single js-states form-control js-courses" id="validationCustom02" name="course_id" required>
                                @foreach ($courses as $course)
                                    <option></option>
                                    <option value="{{ $course->id }}">{{ $course->name }} | {{ $course->price." Bs." }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un curso.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex flex-wrap justify-content-evenly">
                        <div class="col-md-6 mb-4">
                            <label>NIT</label>
                            <input type="number" class="form-control" name="nit" value="0">
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="validationCustom08">Razón social: </label>
                            <input type="text" name="business_name" class="form-control" value="SIN NOMBRE" id="validationCustom08">
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex flex-wrap justify-content-evenly">
                        <div class="col-md-12 mb-4">
                            <label for="validationCustom04">Concepto :</label>
                            <textarea name="concept" class="form-control" name="concept" cols="30" rows="2" id="validationCustom04" placeholder="Ingrese el concepto..." required></textarea>
                            <div class="invalid-feedback">
                                Por favor ingrese un concepto.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12 d-flex flex-wrap justify-content-evenly">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom05">Fecha Inicio :</label>
                            <input type="date" name="start_date" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Por favor ingrese una fecha de inicio.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom06">Monto :</label>
                            <input type="number" class="form-control" name="mount" id="validationCustom06" min="0" required>
                            <div class="invalid-feedback">
                                Por favor ingrese un monto.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom07">Pago :</label>
                            <select name="method_payment" class="form-control" id="validationCustom07" required>
                                <option value="">Seleccione una opción</option>
                                <option value="parcial">Parcial</option>
                                <option value="completo">Completo</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un método de pago.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary mt-3 mx-3 py-2 px-3" type="submit">Inscribir</button>
                </div>

            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Seleccione un estudiante",
            allowClear: true,
            width: '100%',
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-courses').select2({
            placeholder: "Seleccione un curso",
            allowClear: true,
            width: '100%'
        });
    });
</script>

<script>
    (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    })
    })()
</script>

@stop
