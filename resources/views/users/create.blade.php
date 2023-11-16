<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Usuarios</span>
    <button type="button" class="btn btn-primary float-right mt-1" data-toggle="modal" data-target="#crearUsuarioModal">
        <i class="fa fa-solid fa-user"></i>
        Nuevo Usuario
    </button>
</div>
<div class="modal fade" id="crearUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light ">
            <div class="modal-header bg-modal">
                <h5 class="modal-title font-weight-bold text-light-emphasis" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="border-0 rounded-sm header-modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST" id="crearUsuarioForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="name" label="Nombre :" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-name"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="lastname" label="Apellidos :" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-lastname"></span>
                        </div>


                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="ci" label="Cédula de Identidad :" type="number" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-ci"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="phone" label="Teléfono :" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-phone"></span>
                        </div>

                        <div class="col-lg-12 col-12">
                            <x-adminlte-input name="email" label="Correo Electrónico :" type="email" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-envelope text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-email"></span>
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

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label campo-requerido">Roles:</label><br>
                                @foreach($roles as $role)
                                    <div class="form-radio">
                                        <input type="radio" name="roles[]" value="{{ $role->id }}" class="form-radio-input">
                                        <label class="form-radio-label">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                                <span class="text-danger" id="error-roles"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-arrow-circle-left"></i> Atrás</button>
                        <x-adminlte-button class="btn-flat rounded boton-registro-modal" type="submit" label="Registrar" theme="success" icon="fas fa-lg fa-save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
