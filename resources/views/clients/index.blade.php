@extends('adminlte::page')

@section('title', 'Alumnos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="mt-2">
        @include('clients.create')
        <div class="text-secondary mt-4">
            <table id="datatable" class="table responsive nowrap" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Ci / Pasaporte</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Teléfono de referencia</th>
                        <th>Fecha de Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $index => $client)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->lastname }}</td>
                        <td>{{ $client->age }}</td>
                        <td>{{ $client->ci }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->reference_phone }}</td>
                        <td>{{ $client->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-xs btn-default text-primary shadow" title="Editar">
                                    <i class="fa fa-fw fa-pen"></i>
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-default text-danger shadow" title="Eliminar">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script type="text/javascript">
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
                $('#error-age').text('');
                $('#error-ci').text('');
                $('#error-email').text(''),
                $('#error-phone').text('');
                $('#error-reference_phone').text('');


                let mount = response.mount;
                $('#mountElement').text('Mount: ' + mount);
                // setTimeout(function() {
                //     $('#crearCursoModal').modal('hide');
                // });
                setTimeout(function() {
                    window.location.reload();
                }, 700);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('#error-name').text(errors.name ? errors.name[0] : '');
                    $('#error-lastname').text(errors.lastname ? errors.lastname[0] : '');
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
