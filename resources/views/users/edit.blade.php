@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content')
<div class="container mt-4">
    <div class="card bg-light mt-2 shadow">
        <div class="card-header bg-modal">
            <h2>Editar Usuario</h2>
        </div>
        <form action="{{route('users.update', $user->id )}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <x-adminlte-input name="name" label="Nombre Completo :" value="{{$user->name}}" label-class="text-light-emphasis campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="lastname" label="Apellidos :" value="{{$user->lastname}}"  label-class="text-light-emphasis campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-user text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="email" label="Correo Electrónico :" value="{{$user->email}}"  type="email" label-class="text-light-emphasis campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-6">
                        <x-adminlte-input name="phone" label="Teléfono :" value="{{$user->phone}}"  label-class="text-light-emphasis campo-requerido" min="0">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-phone text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input name="ci" label="Cédula de Identidad :" type="number" value="{{$user->ci}}" label-class="text-secondary campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-id-card text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-ci"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input name="password" label="Contraseña :" type="password" label-class="text-secondary campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-password"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <x-adminlte-input name="password_confirmation" label="Confirmar Contraseña :" type="password" label-class="text-secondary campo-requerido">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock text-secondary"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <span class="text-danger" id="error-password-confirm"></span>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Roles:</label><br>
                            @foreach($roles as $role)
                                <div class="form-radio">
                                    <input type="radio" name="roles[]" value="{{ $role->id }}" class="form-radio-input"
                                        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <label class="form-radio-label">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center py-2 pb-4">
                <div>
                    <a class="btn btn-primary mx-3" href="{{route('users.index')}}"><i class="fas fa-ban"></i> Cancelar</a>
                    <x-adminlte-button class="btn-flat rounded" type="submit" label="Guardar Cambios" theme="success" icon="fas fa-lg fa-save"/>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
