<?php

use App\Http\Controllers\AdmFuncController;
use App\Http\Controllers\AdmTempController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PassController;
use App\Http\Controllers\PostController;
use App\Http\Livewire\Registro;
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
// Route::get('/inicio', function () {
//     return view('index');
// });

Route::get('/inicio', HomeController::class);
Route::get('paciente/registro', Registro::class)->name('registro');

//  RUTAS DE PACIENTES
Route::controller(PacienteController::class)->group( function ()
{
    Route::get('paciente/profile','profile');
    Route::get('paciente/reservar','reservar');
 
    Route::get('paciente/turnos-reservados','reservados');
});

// RUTAS ADM FUNCIONALIDADES

Route::controller(AdmFuncController::class) -> group( function ()
{
    Route::get('admfunc/registro-doctor', 'registro');
    Route::get('admfunc/alta-doctor', 'alta');
    Route::get('admfunc/calendario-doctor', 'calendario');
    Route::get('admfunc/importe', 'importe');
    Route::get('admfunc/edit-importe','edit');
    Route::get('admfunc/historial-citas','historial');
    Route::get('admfunc/reservar-adm','reserva');
    Route::get('admfunc/alta-reser-adm','altaReser');
    
});

//  RUTAS DE POST
Route::controller(PostController::class)->group(function ()
{
    Route::get('post/crear', 'crear');
    Route::get('post/alta', 'alta');
});


//  RUTAS COMUNES EN TODOS LOS USUARIOS
Route::get('/cambiar-pass', [PassController::class, 'cambiar']);
Route::get('/cambiar-correo', [EmailController::class, 'cambiar']);

//  RUTAS DE DOCTOR 
Route::get('doctor/agenda',[DoctorController::class, 'agenda']);

// RUTAS DE AGENDA CONSULTORIO
Route::get('consultorio/agenda',[ConsultorioController::class,'agenda']);

//  RUTAS DE ADMIN TEMPLATE 
Route::get('adm/dashboard', [AdmTempController::class,'dashboard']);

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
