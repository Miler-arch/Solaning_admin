{{-- <div class="card-header bg-dark">
    <span class="display-4 font-weight-bold">Cursos</span>
        <button type="button" class="btn btn-primary float-right mt-3" data-toggle="modal" data-target="#crearCursoModal">
        <i class="fas fa-book"></i>
        Crear Curso
    </button>
</div> --}}
<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Cursos</span>
    <button type="button" class="btn btn-primary float-right mt-1" data-toggle="modal" data-target="#crearCursoModal">
        <i class="fas fa-book-reader"></i>
        Nuevo Curso
    </button>
</div>
<div class="modal fade" id="crearCursoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-light-emphasis" id="exampleModalLabel">Nuevo Curso - Programa</h5>
                <button type="button" class="bg-danger rounded border-0 ps-3 pb-1 pe-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('courses.store') }}" method="POST" id="crearCursoForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="text" name="name" id="name" label="Nombre :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-name"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="text" name="version" id="version" label="Versión :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </x-slot>

                            </x-adminlte-input>
                            <span class="text-danger" id="error-version"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label>Categorías :</label>
                            <select name="category" id="" class="form-select">
                                <option value="0">Seleccione una categoría</option>
                                <option value="1">Cursos Presenciales</option>
                                <option value="2">Curso virtual en vivo</option>
                                <option value="3">Curso virtual grabado</option>
                            </select>
                            <span class="text-danger" id="error-category"></span>
                        </div>
                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="number" min="0" name="price" id="price" label="Precio :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-price"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="number" min="0" name="discount" id="discount" label="Descuento :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-discount"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="date" name="expire_date" id="expire_date" label="Fecha de expiración :" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-expire_date"></span>
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
