@extends('adminlte::page')

@section('title', 'Editar Alumno')

@section('content')
<div class="container mt-4">
    <div class="card bg-light mt-2 shadow">
        <div class="card-header bg-modal">
            <h2>Editar Alumno</h2>
        </div>
        <form action="{{route('clients.update', $client->id )}}" method="POST" id="updateClientForm">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <x-adminlte-input name="name" label="Nombre Completo :" value="{{$client->name}}" label-class="text-secondary campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-name"></span>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="lastname" label="Apellidos :" value="{{$client->lastname}}"  label-class="text-secondary campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-lastname"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input name="birthdate" label="Fecha de nacimiento :" type="date" value="{{$client->birthdate}}" label-class="text-secondary">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-birthdate"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input name="city" label="Ciudad :" type="text" label-class="text-secondary" value="{{$client->city}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-city text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-city"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input name="training" label="Formación Académica :" type="text" label-class="text-secondary" value="{{$client->training}}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-graduation-cap text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-training"></span>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="ci" label="Cedula de Identidad :" value="{{$client->ci}}"  type="number" label-class="text-secondary campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-ci"></span>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="email" label="Correo Electrónico :" value="{{$client->email}}"  type="email" label-class="text-secondary">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-email"></span>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="phone" label="Teléfono :" value="{{$client->phone}}"  label-class="text-secondary campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-phone"></span>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="reference_phone" label="Teléfono de Referencia :" value="{{$client->reference_phone}}"  label-class="text-secondary">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-reference_phone"></span>
                    </div>
                </div>
            </div>
            <div class="text-center py-2 pb-4">
                <div>
                    <a class="btn btn-primary mx-3" href="{{route('clients.index')}}"><i class="fas fa-ban"></i> Cancelar</a>
                    <x-adminlte-button type="submit" class="btn-flat rounded" id="update-client-btn" label="Guardar Cambios" theme="success" icon="fas fa-lg fa-save"/>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
