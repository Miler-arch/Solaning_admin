@extends('adminlte::page')

@section('title', 'Cursos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
    @include('courses.create')
    <div class="mt-3">
        <table id="datatable" class="table responsive nowrap" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Acciones</th>
                    <th>Estado</th>
                    <th>Nombre</th>
                    <th>Versión</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Fecha de Inicio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-default text-primary shadow mr-1 rounded-circle fa-editado" title="Editar">
                                <i class="fa fa-fw fa-pen"></i>
                            </a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-default text-danger shadow rounded-circle fa-editado" title="Eliminar">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('courses.updateState', $course) }}" method="POST" class="updateStatus">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="{{ $course->status }}">
                            <button type="button" class="btn btn-flat btn-default text-{{ $course->status ? 'success' : 'danger' }} shadow updateButton" title="{{ $course->status ? 'Activo' : 'Inactivo' }}">
                                <i class="fa fa-fw fa-{{ $course->status ? 'check-circle' : 'times-circle' }}"></i> {{ $course->status ? 'Activo' : 'Inactivo' }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->version }}</td>
                    <td>{{ $course->category }}</td>
                    <td>{{ $course->price." Bs." }}</td>
                    <td>{{ $course->discount. " %" }}</td>
                    <td>{{ $course->start_date }}</td>
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
    $(document).ready(function() {
        $('#update-course-btn').on('click', function(event) {
            event.preventDefault();

            $.ajax({
                url: $('#updateCourseForm').attr('action'),
                type: 'PUT',
                dataType: 'json',
                data: $('#updateCourseForm').serialize(),
                success: function(response) {
                    console.log(response);
                    alert('Curso actualizado exitosamente.');
                    window.location.href = '{{ route('courses.index') }}';
                },
                error: function(error) {
                    console.error(error);
                    alert('Error al actualizar el curso.');
                }
            });
        });
    });
</script>
<script>
$('.updateStatus').on('click', '.updateButton', function(e){
    e.preventDefault();

    let form = $(this).closest('form');

    Swal.fire({
        title: '¿Está seguro de cambiar el estado del curso?',
        text: 'El curso se cambiará de estado.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fa fa-fw fa-check-circle"></i> Sí, cambiar',
        cancelButtonText: '<i class="fa fa-fw fa-times-circle"></i> Cancelar',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Hecho!',
                        text: data.success,
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(error) {
                    Swal.fire('Error', data.error, 'error');
                }
            });
        }
    });
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
                $('#error-category').text('');
                $('#error-price').text('');
                $('#error-discount').text('');
                $('#error-start_date').text('');
                setTimeout(function() {
                    window.location.reload();
                }, 700);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('#error-name').text(errors.name ? errors.name[0] : '');
                    $('#error-category').text(errors.category ? errors.category[0] : '');
                    $('#error-price').text(errors.price ? errors.price[0] : '');
                    $('#error-discount').text(errors.discount ? errors.discount[0] : '');
                    $('#error-start_date').text(errors.start_date ? errors.start_date[0] : '');
                } else if (xhr.status === 400){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.responseJSON.error,
                    });
                }
            }
        });
    });
});

</script>
@stop
