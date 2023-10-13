@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Datatables', true)

@section('content')
    <div class="mt-3 p-3 rounded contenedor-header">
        <span class="font-weight-bold titulo-header">Dashboard</span>
    </div>
    <div class="mt-3 p-3 rounded">
        <span class="font-weight-bold titulo-saludo">Bienvenido Alexander 👋🏻</span>
    </div>
    <div class="py-5">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="small-box d-usuarios">
                    <div class="inner d-info-usuarios">
                        <h3>{{$users}}</h3>
                        <p>Usuarios Registrados</p>
                    </div>
                    <div class="icon d-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="#" class="d-flex justify-content-center align-items-center small-box-footer py-2 d-icon-2">
                        Más información<i class="fas fa-arrow-alt-circle-right px-2"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>{{$clients}}</h3>
                    <p>Alumnos registrados</p>
                </div>
                <div class="icon d-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <a href="{{route('clients.index')}}" class="d-flex justify-content-center align-items-center small-box-footer py-2 d-icon-2">
                    Más información<i class="fas fa-arrow-alt-circle-right px-2"></i>
                </a>
                </div>
            </div>

            <div class="col-lg-3 col-12">
                <div class="small-box d-inscritos">
                <div class="inner d-info-inscritos">
                    <h3>{{$inscriptions}}</h3>
                    <p>Total inscritos</p>
                </div>
                <div class="icon d-icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('list_registrations')}}" class="d-flex justify-content-center align-items-center small-box-footer py-2 d-icon-2">
                    Más información<i class="fas fa-arrow-alt-circle-right px-2"></i>
                </a>
                </div>
            </div>

            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-warning">
                <div class="inner d-info-cursos">
                    <h3>{{$courses}}</h3>
                    <p>Cursos</p>
                </div>
                <div class="icon d-icon">
                    <i class="fas fa-book-reader"></i>
                </div>
                <a href="{{route('courses.index')}}" class="d-flex justify-content-center align-items-center small-box-footer py-2 d-icon-2">
                    Más información<i class="fas fa-arrow-alt-circle-right px-2"></i>
                </a>
                </div>
            </div>


            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-danger">
                <div class="inner d-info-cursos">
                    <h3>{{$inscriptionsStatePartial}}</h3>
                    <p>Pagos Parciales</p>
                </div>
                <div class="icon d-icon">
                    <i class="fas fa-book-reader"></i>
                </div>

                    <a href="{{route('list_registrations')}}" class="d-flex justify-content-center align-items-center small-box-footer py-2 d-icon-2">
                        Más información<i class="fas fa-arrow-alt-circle-right px-2"></i>
                    </a>

                </div>
            </div>


            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-cyan">
                <div class="inner d-info-cursos">
                    <h3>{{$inscriptionsStateComplete}}</h3>
                    <p>Pagos Completados</p>
                </div>
                <div class="icon d-icon">
                    <i class="fas fa-book-reader"></i>
                </div>
                <a href="{{route('list_registrations')}}" class="d-flex justify-content-center align-items-center small-box-footer py-2 d-icon-2">
                    Más información<i class="fas fa-arrow-alt-circle-right px-2"></i>
                </a>
                </div>
            </div>
        </div>
    </div>
@stop
