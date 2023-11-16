@extends('adminlte::page')

@section('title', 'Alumnos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
    @include('clients.create')
    <div class="mt-3">
        <table id="datatable" class="table responsive nowrap" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Acciones</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de nacimiento</th>
                    <th>Edad</th>
                    <th>Ci / Pasaporte</th>
                    <th>Ciudad</th>
                    <th>Formación</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Teléfono de referencia</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $index => $client)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-default text-primary shadow mr-2 rounded-circle fa-editado" title="Editar">
                                <i class="fa fa-fw fa-pen"></i>
                            </a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-default text-danger shadow rounded-circle fa-editado" title="Eliminar">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->lastname }}</td>
                    <td>
                        @if($client->birthdate == null)
                            <span class="badge badge-warning p-2">Sin fecha</span>
                        @else
                            {{ $client->birthdate }}
                        @endif
                    </td>
                    <td>
                        @if($client->birthdate == null)
                            <span class="badge badge-warning p-2">Sin edad</span>
                        @else
                            {{ \Carbon\Carbon::parse($client->birthdate)->age }}
                        @endif
                    </td>
                    <td>{{ $client->ci }}</td>
                    <td>
                        @if ($client->city == null)
                            <span class="badge badge-warning p-2">Sin ciudad</span>
                        @else
                            {{ $client->city }}
                        @endif
                    </td>

                    <td>
                        @if ($client->training == null)
                            <span class="badge badge-warning p-2">Sin formación</span>
                        @else
                            {{ $client->training }}
                        @endif
                    </td>
                    <td>
                        @if ($client->email == null)
                            <span class="badge badge-warning p-2">Sin correo</span>
                        @else
                            {{ $client->email }}
                        @endif
                    </td>
                    <td>{{ $client->phone }}</td>
                    <td>
                        @if ($client->reference_phone == null)
                            <span class="badge badge-warning p-2">Sin número</span>
                        @else
                            {{ $client->reference_phone }}
                        @endif
                    </td>
                    <td>{{ $client->created_at->format('d-m-Y H:i:s') }}</td>
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
            text: "El alumno se eliminara definitivamente.",
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
<script>
    $(document).ready(function() {
        $('#update-client-btn').on('click', function(event) {
            event.preventDefault();

            $.ajax({
                url: $('#updateClientForm').attr('action'),
                type: 'PUT',
                dataType: 'json',
                data: $('#updateClientForm').serialize(),
                success: function(response) {
                    console.log(response);
                    alert('Alumno actualizado exitosamente.');
                    window.location.href = '{{ route('courses.index') }}';
                },
                error: function(error) {
                    console.error(error);
                    alert('Error al actualizar el alumno.');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
    $('#crearClienteForm').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('clients.store') }}",
            data: $('#crearClienteForm').serialize(),
            success: function (response) {
                $('#crearClientModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.success,
                    showConfirmButton: false,
                    timer: 1000
                });
                $('#crearClienteForm')[0].reset();
                $('#error-name').text('');
                $('#error-lastname').text('');
                $('#error-birthdate').text('');
                $('#error-city').text('');
                $('#error-training').text('');
                $('#error-age').text('');
                $('#error-ci').text('');
                $('#error-email').text('');
                $('#error-phone').text('');
                $('#error-reference_phone').text('');
                setTimeout(function() {
                    window.location.reload();
                }, 700);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('#error-name').text(errors.name ? errors.name[0] : '');
                    $('#error-lastname').text(errors.lastname ? errors.lastname[0] : '');
                    $('#error-birthdate').text(errors.birthdate ? errors.birthdate[0] : '');
                    $('#error-city').text(errors.city ? errors.city[0] : '');
                    $('#error-training').text(errors.training ? errors.training[0] : '');
                    $('#error-age').text(errors.age ? errors.age[0] : '');
                    $('#error-ci').text(errors.ci ? errors.ci[0] : '');
                    $('#error-email').text(errors.email ? errors.email[0] : '');
                    $('#error-phone').text(errors.phone ? errors.phone[0] : '');
                    $('#error-reference_phone').text(errors.reference_phone ? errors.reference_phone[0] : '');
                }
            }
        });
    });
});
</script>
@stop
