@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content')
<div class="container">
    <div class="card bg-dark mt-2">
        <div class="card-header bg-dark">
            <h2>Editar Curso</h2>
        </div>
        <form action="{{route('courses.update', $course->id )}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="text" name="name" id="name" label="Nombre :" value="{{$course->name}}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-name"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="text" name="version" id="version" label="Versión :" value="{{$course->version}}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </x-slot>

                        </x-adminlte-input>
                        <span class="text-danger" id="error-version"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="text" min="0" name="category" id="category" label="Categoría :" value="{{$course->category}}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-category"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="number" min="0" name="price" id="price" label="Precio :" value="{{$course->price}}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-precio"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="text" name="discount" id="discount" label="Descuento :" value="{{$course->discount}}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-discount"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input type="date" name="expire_date" id="expire_date" label="Fecha de expiración :" value="{{$course->expire_date}}" label-class="text-lightblue">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-book"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-expire_date"></span>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <div>
                    <a class="btn btn-primary" href="{{route('courses.index')}}">Cancelar</a>
                    <x-adminlte-button class="btn-flat rounded" type="submit" label="Guardar Cambios" theme="success" icon="fas fa-lg fa-save"/>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
