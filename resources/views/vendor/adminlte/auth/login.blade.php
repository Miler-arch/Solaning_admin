{{-- @extends('adminlte::auth.auth-page', ['auth_type' => 'login']) --}}
@extends('adminlte::master')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('adminlte_css')
    @stack('css')
    <link href="{{ asset('vendor/adminlte/dist/css/custom.css') }}" rel="stylesheet">
    @yield('css')
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

{{-- @section('auth_body') --}}
<div class="body-contenedor-login">
    <div class="row justify-content-center cuerpo-row rounded">

    <div class="col-5 d-none d-lg-block cover shadow-lg">
        {{-- <img src="{{asset('img/cover-login.jpg')}}" alt="" class="w-100 cover-login"> --}}
    </div>   

    <div class="col-lg-4 col-md-6 col-sm-8 login-cuerpo shadow-lg">
        <img src="{{asset('img/logo.png')}}" alt="" class="logo-login my-4">
        <form action="{{ $login_url }}" method="post">
            @csrf
            {{-- Email field --}}
            <div class="input-group inputs mb-4">
                <div class="input-group-append">
                    <div class="input-group-text login-iconos">
                        <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                
                <input type="email" name="email" class="form-control login-input @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
    
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            {{-- Password field --}}
            <div class="input-group inputs mb-1">
                <div class="input-group-append">
                    <div class="input-group-text login-iconos">
                        <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                
                <input type="password" name="password" class="form-control login-input @error('password') is-invalid @enderror"
                       placeholder="{{ __('adminlte::adminlte.password') }}">
    
    
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            {{-- Login field --}}
            {{-- <div class="row">
                <div class="col-7">
                    <div class="icheck-primary" title="{{ __('adminlte::adminlte.remember_me_hint') }}">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                        <label for="remember">
                            {{ __('adminlte::adminlte.remember_me') }}
                        </label>
                    </div>
                </div>
    
                <div class="col-5">
                    <button type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                        <span class="fas fa-sign-in-alt"></span>
                        {{ __('adminlte::adminlte.sign_in') }}
                    </button>
                </div>
            </div> --}}

            {{-- Password reset link --}}
        @if($password_reset_url)
            <p class="my-0 reset-password">
                <a href="{{ $password_reset_url }}">
                    {{ __('adminlte::adminlte.i_forgot_my_password') }}
                </a>
            </p>
        @endif
    
            <div class="button-container my-4">
                <button type=submit class="btn btn-block py-2">
                    {{-- <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }} --}}
                    Iniciar Sesión
                </button>

                <p class="text-center mt-4 text-black-50 fw-bold">Solaning - <span id="fecha" class="m-auto"></span></p>
            </div>
        </form>

        
        
        {{-- Register link --}}
        {{-- @if($register_url)
            <p class="my-0">
                <a href="{{ $register_url }}">
                    {{ __('adminlte::adminlte.register_a_new_membership') }}
                </a>
            </p>
        @endif --}}
    </div>
    {{-- @stop --}}
    </div>
</div>

<script>
    let fecha = new Date();
    let year = fecha.getFullYear();
    let contenedor = document.getElementById('fecha');
    contenedor.innerHTML = year;
</script>

{{-- @section('auth_footer') --}}
{{-- @stop --}}
