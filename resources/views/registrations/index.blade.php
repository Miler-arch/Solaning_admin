@extends('adminlte::page')

@section('title', 'Registrations')
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
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

                    <input type="hidden" name="user_id">
                    <div class="col-12 d-flex flex-wrap justify-content-evenly">
                        <div class="col-md-6 mb-4">
                            <label for="validationCustom01" class="font-weight-bold">Estudiante :</label>
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
                            <label for="validationCustom02" class="font-weight-bold">Curso :</label>
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
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom07" class="font-weight-bold">Descuento (%):</label>
                            <input type="number" class="form-control" name="discount" value="0" id="validationCustom07" min="0">
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="font-weight-bold">Precio con Descuento (Bs):</label>
                            {{-- <span id="discountedPrice"></span> --}}
                            <input type="text" class="form-control" min="0" value="0" readonly id="discountedPrice" name="discounted_price">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom06" class="font-weight-bold">Monto (Bs):</label>
                            <input type="text" class="form-control" name="mount" id="validationCustom06" min="0" required>
                            <div class="invalid-feedback">
                                Por favor ingrese un monto.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="font-weight-bold">NIT :</label>
                            <input type="number" class="form-control" name="nit" value="0" min="0">
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="validationCustom08" class="font-weight-bold">Razón social :</label>
                            <input type="text" name="business_name" class="form-control" value="SIN NOMBRE" id="validationCustom08">
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom05" class="font-weight-bold">Fecha Inicio :</label>
                            <input type="date" name="start_date" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Por favor ingrese una fecha de inicio.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>

                        <input type="hidden" name="method_payment" id="method_payment">
                    </div>
                </div>
                <div class="d-grid gap-2 py-2">
                    <button class="btn btn-primary mt-3 mx-3 py-2 px-3 font-weight-bold" type="submit">INSCRIBIR</button>
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
<script>
    let courseSelect = document.getElementById("validationCustom02");
    let discountInput = document.getElementById("validationCustom07");

    discountInput.addEventListener("input", function() {
        let selectedCoursePrice = parseFloat(courseSelect.options[courseSelect.selectedIndex].text.split('|')[1].replace(' Bs.', '').trim());
        let discountValue = parseFloat(discountInput.value);
        let discountedPrice = selectedCoursePrice - (selectedCoursePrice * (discountValue / 100));
        let discountedPriceElement = document.getElementById("discountedPrice");
        discountedPriceElement.value = discountedPrice.toFixed(2);
    });
</script>

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: '{{ session('error') }}'
        });
    </script>
@endif
@stop
