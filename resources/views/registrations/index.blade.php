@extends('adminlte::page')

@section('title', 'Inscripciones')
@section('plugins.Select2', true)
@section('plugins.Datatables', true)

@section('content')
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Inscripciones</span>
</div>
<div class="mt-3">
    <div class="contenedor-inscripciones card mt-4">
        <div class="card-body contenedor-card">
            <form action="{{route('registrations.store')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">

                    <input type="hidden" name="user_id">
                    <div class="col-12 d-flex flex-wrap justify-content-evenly">
                        <div class="col-md-4 mb-4">
                            <label for="validationCustom01" class="font-weight-bold">Estudiante :</label>
                            <select class="js-example-basic-single js-states form-control" id="validationCustom01" name="client_id" required>
                                @foreach ($clients as $client)
                                    <option></option>
                                    <option value="{{ $client->id }}">{{ $client->lastname }} | {{ $client->ci }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione un estudiante.
                            </div>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="validationCustom02" class="font-weight-bold">Curso :</label>
                            <select class="js-example-basic-single js-states form-control js-courses" id="validationCustom02" name="course_id" required>
                                @foreach ($courses as $course)
                                    <option></option>
                                    <option value="{{ $course->id }}">{{ $course->name }} | {{ $course->price." Bs." }} | {{$course->version}}</option>
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
                            <label class="font-weight-bold">Precio con Descuento (Bs.):</label>
                            <input type="text" class="form-control" min="0" value="0" readonly id="discountedPrice" name="discounted_price">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom06" class="font-weight-bold">A Cuenta (Bs.):</label>
                            <input type="text" class="form-control" name="mount" id="validationCustom06" min="0" required step="0.01">
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

                        <div class="col-md-4 mb-4">
                            <label for="validationCustom09" class="font-weight-bold">Tipo de Pago :</label>
                            <select class="form-control" id="validationCustom09" name="type_payment" required>
                                <option selected disabled value="">-- Seleccione el tipo de pago --</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Depósito Bancario">Depósito Bancario</option>
                                <option value="QR">QR</option>
                            </select>
                            <div class="valid-feedback">
                                Bien hecho!
                            </div>
                            <div class="invalid-feedback">
                                Por favor ingrese el tipo de pago.
                            </div>
                        </div>

                        <input type="hidden" name="method_payment" id="method_payment">
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <button class="ov-btn-slide-left" type="submit">
                            INSCRIBIR<span class="arrow"><i class="fas fa-chevron-right fa-fw"></i></span>
                        </button>
                    </div>
                </div>
            </form>
            <!-- <div class="custom-loader"></div> -->
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

    const forms = document.querySelectorAll('.needs-validation')
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

@stop
