@extends('adminlte::page')

@section('title', 'Usuarios')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
    @include('users.create')
    <div class="mt-3">
        <table id="datatable" class="table responsive nowrap" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Acciones</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Carnet de Identidad</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-default text-primary shadow mr-2 rounded-circle fa-editado" title="Editar">
                                <i class="fa fa-fw fa-pen"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-default text-danger shadow rounded-circle fa-editado" title="Eliminar">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->ci }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if($user->roles->count() > 0)
                            <span class="bg-primary rounded p-1">{{ $user->roles[0]->name }}</span>
                        @else
                            Sin Rol Asignado
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d-m-Y H:i:s') }}</td>
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
            text: "El usuario se eliminara definitivamente.",
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
    $('#crearUsuarioForm').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('users.store') }}",
            data: $('#crearUsuarioForm').serialize(),
            success: function (response) {
                $('#crearUsuarioModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.success,
                    showConfirmButton: false,
                    timer: 1000
                });
                $('#crearUsuarioForm')[0].reset();
                $('#error-name').text('');
                $('#error-lastname').text('');
                $('#error-ci').text('');
                $('#error-email').text(''),
                $('#error-phone').text('');
                $('#error-passowrd').text('');
                $('#error-password-confirm').text('');
                $('#error-roles').text('');
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
                    $('#error-ci').text(errors.ci ? errors.ci[0] : '');
                    $('#error-email').text(errors.email ? errors.email[0] : '');
                    $('#error-phone').text(errors.phone ? errors.phone[0] : '');
                    $('#error-password').text(errors.password ? errors.password[0] : '');
                    $('#error-password-confirm').text(errors.password_confirmation ? errors.password_confirmation[0] : '');
                    $('#error-roles').text(errors.roles ? errors.roles[0] : '');
                }
            }
        });
    });
});
</script>

@stop
