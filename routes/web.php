<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/inicio', function () {
    return view('index');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/registro-doctor', function () {
    return view('registro-doctor');
});

Route::get('/alta-doctor', function () {
    return view('alta-doctor');
});
Route::get('/calendario-doctor', function () {
    return view('calendario-doctor');
});

Route::get('/importe', function () {
    return view('importe-consulta');
});

Route::get('/edit-importe', function () {
    return view('editar-importe');
});
Route::get('/crear-post', function () {
    return view('crear-post');
});

Route::get('/alta-post', function () {
    return view('alta-post');
});

Route::get('/cambiar-pass', function () {
    return view('cambiar-password');
});

Route::get('/cambiar-correo', function () {
    return view('cambiar-email');
});

Route::get('/reservar', function () {
    return view('reservar');
});

Route::get('/reservar-adm', function () {
    return view('reservar-admin');
});

Route::get('/alta-reser-adm', function () {
    return view('alta-reserva');
});


Route::get('/turnos-reservados', function () {
    return view('turnos-reservados');
});


Route::get('/doctor-agenda', function () {
    return view('reserva-doctor-agenda');
});


Route::get('/consultorio-agenda', function () {
    return view('reservas-consultorio-agenda');
});

Route::get('/historial-cita', function () {
    return view('historial-citas');
});



Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
