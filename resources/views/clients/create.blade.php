{{-- <div class="card-header bg-dark">
    <span class="display-4 font-weight-bold">Alumnos</span>
        <button type="button" class="btn btn-primary float-right mt-3" data-toggle="modal" data-target="#crearClienteModal">
        <i class="fas fa-book"></i>
        Crear Alumno
    </button>
</div> --}}
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Alumnos</span>
    <button type="button" class="btn btn-primary float-right mt-1" data-toggle="modal" data-target="#crearClienteModal">
        <i class="fa fa-solid fa-user-graduate"></i>
        Nuevo Alumno
    </button>
</div>
<div class="modal fade" id="crearClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-light-emphasis" id="exampleModalLabel">Nuevo Alumno</h5>
                <button type="button" class="bg-danger rounded border-0 ps-3 pb-1 pe-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clients.store') }}" method="POST" id="crearClienteForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="name" label="Nombre :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-name"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="lastname" label="Apellidos :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-lastname"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="age" label="Edad :" type="number" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-age"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="ci" label="Cédula de Identidad :" type="number" label-class="text-secondary">
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
                            <x-adminlte-input name="phone" label="Teléfono :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-phone"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input name="reference_phone" label="Teléfono de Referencia :" label-class="text-secondary">
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cerrar</button>
                        <x-adminlte-button class="btn-flat rounded" type="submit" label="Registrar" theme="success" icon="fas fa-lg fa-save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
