@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content')
<div class="container mt-4">
    <div class="card bg-light mt-2 shadow">
        <div class="card-header bg-light">
            <h2>Editar Curso</h2>
        </div>
        <form action="{{route('courses.update', $course->id )}}" method="POST" id="updateCourseForm">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="text" name="name" id="name" label="Nombre :" value="{{$course->name}}" label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-name"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="text" name="version" id="version" label="Versión :" value="{{$course->version}}" label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-code-branch"></i>
                                </div>
                            </x-slot>

                        </x-adminlte-input>
                        <span class="text-danger" id="error-version"></span>
                    </div>
                    <div class="col-lg-6 col-12">
                        <label for="category">Categorías :</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Seleccione una categoría</option>
                            <option value="Curso presencial" {{ $course->category === 'Curso presencial' ? 'selected' : '' }}>Curso presencial</option>
                            <option value="Curso virtual en vivo" {{ $course->category === 'Curso virtual en vivo' ? 'selected' : '' }}>Curso virtual en vivo</option>
                            <option value="Curso virtual grabado" {{ $course->category === 'Curso virtual grabado' ? 'selected' : '' }}>Curso virtual grabado</option>
                        </select>
                        <span class="text-danger" id="error-category"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="number" min="0" name="price" id="price" label="Precio (Bs):" value="{{$course->price}}" label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-precio"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="text" name="discount" id="discount" label="Descuento (%):" value="{{$course->discount}}" label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-tag"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-discount"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="date" name="start_date" id="start_date" label="Fecha de Inicio :"
                                        value="{{ old('start_date', \Carbon\Carbon::parse($course->start_date)->format('Y-m-d')) }}"
                                        label-class="text-secondary">
                            <x-slot name="prependSlot">
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-start_date"></span>
                    </div>
                </div>
            </div>
            <div class="text-center py-2 pb-4">
                <div>
                    <a class="btn btn-primary mx-3" href="{{ route('courses.index') }}">Cancelar</a>
                    <button class="btn btn-success" id="update-course-btn">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
