@extends('adminlte::page')

@section('title', 'Registrations')
@section('plugins.Select2', true)

@section('content')
<div class="container">
    <div class="card bg-dark mt-2" style="height: 1000px">
        <div class="card-body">
            <form action="{{route('registrations.store')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
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
                    <div class="col-md-3 mb-3">
                        <label>NIT</label>
                        <input type="text" class="form-control" name="nit">
                        <div class="valid-feedback">
                            Bien hecho!
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom08">Razón social: </label>
                        <input type="text" name="business_name" class="form-control" id="validationCustom08">
                        <div class="valid-feedback">
                            Bien hecho!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom04">Concepto :</label>
                        <textarea name="concept" class="form-control" name="concept" cols="30" rows="10" id="validationCustom04" placeholder="Ingrese el concepto..." required></textarea>
                        <div class="invalid-feedback">
                            Por favor ingrese un concepto.
                        </div>
                        <div class="valid-feedback">
                            Bien hecho!
                        </div>
                    </div>
                </div>

                <div class="form-row">

                    <div class="col-md-3 mb-3">
                        <label for="validationCustom05">Fecha Inicio :</label>
                        <input type="date" name="start_date" class="form-control" id="validationCustom05" placeholder="State" required>
                        <div class="invalid-feedback">
                            Por favor ingrese una fecha de inicio.
                        </div>
                        <div class="valid-feedback">
                            Bien hecho!
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom06">Monto :</label>
                        <input type="number" class="form-control" name="mount" id="validationCustom06"  required>
                        <div class="invalid-feedback">
                            Por favor ingrese un monto.
                        </div>
                        <div class="valid-feedback">
                            Bien hecho!
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="validationCustom07">Pago :</label>
                        <select name="method_payment" class="form-control" id="validationCustom07" required>
                            <option value="">Seleccione una opción</option>
                            <option value="0">Parcial</option>
                            <option value="1">Completo</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccione un método de pago.
                        </div>
                        <div class="valid-feedback">
                            Bien hecho!
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Enviar</button>
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
