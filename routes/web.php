<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListRegistrations;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// DB::listen(function ($query) {
//     dump($query->sql);
// });

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clients', ClientController::class)->name('', 'clients');

    Route::resource('courses', CursoController::class)->name('', 'courses');

    Route::put("courses/{course}/update_state", [CursoController::class, 'updateState'])->name('courses.updateState');

    Route::resource('registrations', RegistrationController::class)->name('', 'registrations');

    Route::get('list_registrations', [ListRegistrations::class, 'index'])->name('list_registrations');

    Route::get('list_registrations/{id}', [ListRegistrations::class, 'pdf'])->name('list_registrations.pdf');

    Route::get('recibe/{id}', [RegistrationController::class, 'pdf'])->name('recibe');

    Route::resource('users', UserController::class)->name('', 'users');
});


