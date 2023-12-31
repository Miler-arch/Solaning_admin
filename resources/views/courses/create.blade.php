<div class="mt-3 p-3 rounded contenedor-header">
    <span class="font-weight-bold titulo-header">Cursos</span>
    <button type="button" class="btn btn-primary float-right mt-1" data-toggle="modal" data-target="#crearCursoModal">
        <i class="fas fa-book-reader"></i>
        Nuevo Curso
    </button>
</div>
<div class="modal fade" id="crearCursoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header bg-modal">
                <h5 class="modal-title font-weight-bold text-light-emphasis" id="exampleModalLabel">Nuevo Curso - Programa</h5>
                <button type="button" class="border-0 rounded-sm header-modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('courses.store') }}" method="POST" id="crearCursoForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <x-adminlte-input type="text" name="name" id="name" label="Nombre :" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-book text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-name"></span>
                        </div>

                        <input type="hidden" name="version" id="version" value="version">

                        <div class="col-lg-6 col-12">
                            <label class="campo-requerido">Categorías :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-list text-secondary"></i>
                                    </span>
                                </div>
                                <select name="category" class="form-control">
                                    <option value="">Seleccione una categoría</option>
                                    <option value="Curso presencial">Curso presencial</option>
                                    <option value="Curso virtual en vivo">Curso virtual en vivo</option>
                                    <option value="Curso virtual grabado">Curso virtual grabado</option>
                                </select>
                            </div>
                            <span class="text-danger" id="error-category"></span>
                        </div>


                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="number" min="0" name="price" id="price" label="Precio (Bs):" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-money-bill text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-price"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="number" min="0" name="discount" value="0" id="discount" label="Descuento (%):" label-class="text-secondary">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-tag text-secondary"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-discount"></span>
                        </div>

                        <div class="col-lg-6 col-12">
                            <x-adminlte-input type="date" name="start_date" id="start_date" label="Fecha de Inicio :" label-class="text-secondary campo-requerido">
                                <x-slot name="prependSlot">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar-alt text-secondary"></i>
                                        </span>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <span class="text-danger" id="error-start_date"></span>
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
