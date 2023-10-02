<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


Route::resource('clients', ClientController::class)->name('', 'clients');

Route::resource('courses', CursoController::class)->name('', 'courses');

Route::resource('registrations', RegistrationController::class)->name('', 'registrations');
