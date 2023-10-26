<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListRegistrations;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clients', ClientController::class)->name('', 'clients');

    Route::resource('courses', CursoController::class)->name('', 'courses');

    Route::resource('registrations', RegistrationController::class)->name('', 'registrations');

    Route::get('list_registrations', [ListRegistrations::class, 'index'])->name('list_registrations');

    Route::get('recibe/{id}', [RegistrationController::class, 'pdf'])->name('recibe');

    Route::resource('users', UserController::class)->name('', 'users');
});


