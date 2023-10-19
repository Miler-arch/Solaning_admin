@extends('adminlte::page')

@section('title', 'Cursos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="mt-2">
        @include('courses.create')
        <div class="text-secondary mt-4">
            <table id="datatable" class="table responsive nowrap" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Versión</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                        <th>Tiempo de Expiración</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $index => $course)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $course->name }}</td>
                        <td>
                            @if($course->status === 1)
                                <span class="badge-success py-1 px-2 rounded">Activo <span class="fa fa-check-circle"></span></span>
                            @else
                                <span class="badge-danger p-1 ps-3 pe-3 rounded">Inactivo <i class="fas fa-times-circle"></i></span>
                            @endif
                        </td>
                        <td>{{ $course->version }}</td>
                        <td>{{ $course->category }}</td>
                        <td>{{ $course->price }} Bs.</td>
                        <td>{{ $course->discount }} Bs.</td>
                        <td>{{ $course->expire_date }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-xs btn-default text-primary shadow" title="Editar">
                                    <i class="fa fa-fw fa-pen"></i>
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="form-eliminar">
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
            text: "El curso se eliminara definitivamente.",
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
    $('#crearCursoForm').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('courses.store') }}",
            data: $('#crearCursoForm').serialize(),
            success: function (response) {
                $('#crearCursoModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.success,
                    showConfirmButton: false,
                    timer: 1000
                });
                $('#crearCursoForm')[0].reset();
                $('#error-name').text('');
                $('#error-state').text('');
                $('#error-version').text('');
                $('#error-category').text('');
                $('#error-price').text('');
                $('#error-discount').text('');
                $('#error-expire_date').text('');
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
                    $('#error-state').text(errors.state ? errors.state[0] : '');
                    $('#error-version').text(errors.version ? errors.version[0] : '');
                    $('#error-category').text(errors.category ? errors.category[0] : '');
                    $('#error-price').text(errors.price ? errors.price[0] : '');
                    $('#error-discount').text(errors.discount ? errors.discount[0] : '');
                    $('#error-expire_date').text(errors.expire_date ? errors.expire_date[0] : '');
                }
            }
        });
    });
});

</script>
@stop
