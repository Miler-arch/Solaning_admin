<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Alumnos</span>
    <button type="button" class="btn btn-primary float-right mt-1" data-toggle="modal" data-target="#crearClienteModal">
        <i class="fa fa-solid fa-user-graduate"></i>
        Nuevo Alumno
    </button>
</div>
<div class="modal fade" id="crearClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-modal">
                <h5 class="modal-title font-weight-bold text-light-emphasis" id="exampleModalLabel">Nuevo Alumno</h5>
                <button type="button" class="border-0 rounded-sm header-modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clients.store') }}" method="POST" id="crearClienteForm">
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
                            <x-adminlte-input name="birthdate" label="Fecha de nacimiento :" type="date" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-birthdate"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="city" label="Ciudad :" type="text" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-city text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-city"></span>
                        </div>


                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="training" label="Formación Académica :" type="text" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-graduation-cap text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-training"></span>
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

                        <div class="col-lg-12 col-12">
                            <x-adminlte-input name="email" label="Correo Electrónico :" type="email" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-envelope text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-email"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="phone" label="Teléfono :" type="tel" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-phone"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="reference_phone" type="tel" label="Teléfono de Referencia :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-reference_phone"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"><i class="fas fa-ban"></i> Cancelar</button>
                        <x-adminlte-button class="btn-flat rounded boton-registro-modal" type="submit" label="Registrar" theme="success" icon="fas fa-lg fa-save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
