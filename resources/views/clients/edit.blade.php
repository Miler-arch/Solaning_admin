@extends('adminlte::page')

@section('title', 'Editar Alumno')

@section('content')
<div class="container mt-4">
    <div class="card bg-light mt-2 shadow">
        <div class="card-header bg-light">
            <h2>Editar Alumno</h2>
        </div>
        <form action="{{route('clients.update', $client->id )}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <x-adminlte-input name="name" label="Nombre Completo :" value="{{$client->name}}" label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-light-emphasis"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="lastname" label="Apellidos :" value="{{$client->lastname}}"  label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-light-emphasis"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="age" label="Edad :" type="number" value="{{$client->age}}"  label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-light-emphasis"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="ci" label="Cedula de Identidad :" value="{{$client->ci}}"  type="number" label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card text-light-emphasis"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="email" label="Correo Electrónico :" value="{{$client->email}}"  type="email" label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope text-light-emphasis"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="phone" label="Teléfono :" value="{{$client->phone}}"  label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-light-emphasis"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="reference_phone" label="Teléfono de Referencia :" value="{{$client->reference_phone}}"  label-class="text-light-emphasis">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-light-emphasis"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>
            </div>
            <div class="text-center py-2 pb-4">
                <div>
                    <a class="btn btn-primary mx-3" href="{{route('clients.index')}}">Cancelar</a>
                    <x-adminlte-button class="btn-flat rounded" type="submit" label="Guardar Cambios" theme="success" icon="fas fa-lg fa-save"/>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
