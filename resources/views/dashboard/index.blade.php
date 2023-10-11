@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Datatables', true)

@section('content')
    <div class="py-5">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{$users}}</h3>
                    <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Más información<i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>{{$clients}}</h3>
                    <p>Alumnos registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{route('clients.index')}}" class="small-box-footer">
                    Más información<i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>

            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-cyan">
                <div class="inner">
                    <h3>{{$inscriptions}}</h3>
                    <p>Total inscritos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{route('list_registrations')}}" class="small-box-footer">
                    Más información<i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>

            <div class="col-lg-3 col-12">
                <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{$courses}}</h3>
                    <p>Cursos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{route('courses.index')}}" class="small-box-footer">
                    Más información<i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
        </div>
    </div>
@stop
