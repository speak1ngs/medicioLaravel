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
use App\Http\Livewire\Altaconsultorio;
use App\Http\Livewire\AltaDoctor;
use App\Http\Livewire\AltaPost;
use App\Http\Livewire\AltaReservaAdmin;
use App\Http\Livewire\CalendarioDoctor;
use App\Http\Livewire\Cambiarpass;
use App\Http\Livewire\Crearconsultorio;
use App\Http\Livewire\Crearhoras;
use App\Http\Livewire\CrearPosts;
use App\Http\Livewire\DoctorAgenda;
use App\Http\Livewire\EditarImporte;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Registro;
use App\Http\Livewire\RegistroDoctor;
use App\Http\Livewire\Reservar;
use App\Http\Livewire\ReservarAdmin;
use App\Http\Livewire\TurnosReservados;
use App\Models\CalendarioDetalles;
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
//  RUTAS DE PACIENTES
Route::get('paciente/registro', Registro::class)->name('registro');
Route::get('paciente/profile', Profile::class)->name('profile');
Route::get('paciente/reservar', Reservar::class)->name('reservar');
Route::get('paciente/turnos-reservados',TurnosReservados::class)->name('reservados');

// RUTAS ADM FUNCIONALIDADES
Route::get('admfunc/registro-doctor', RegistroDoctor::class)->name('registro-doctor');
Route::get('admfunc/alta-doctor', AltaDoctor::class)->name('alta');
Route::get('admfunc/edit-importe', EditarImporte::class)->name('edit');
Route::get('admfunc/calendario-doctor', CalendarioDoctor::class )->name('calendario');
Route::get('admfunc/alta-reser-adm', AltaReservaAdmin::class)->name('altaReser');
Route::get('admfunc/crear-consult', Crearconsultorio::class)->name('consulCreate');
Route::get('admfunc/alta-consult', Altaconsultorio::class)->name('consulAlt');
Route::get('admfunc/reservar-adm',ReservarAdmin::class)->name('reserva');


Route::controller(AdmFuncController::class) -> group( function ()
{
    Route::get('admfunc/importe', 'importe');
    // Route::get('admfunc/historial-citas','historial');
    // Route::get('admfunc/reservar-adm','reserva');
    // Route::get('admfunc/alta-reser-adm','altaReser');
    
});

//  RUTAS DE POST
Route::get('post/crear', CrearPosts::class)->name('crear');
Route::get('post/alta', AltaPost::class)->name('alta');



//  RUTAS COMUNES EN TODOS LOS USUARIOS
Route::get('/cambiar-pass', Cambiarpass::class)->name('cambiar');
// Route::get('/cambiar-correo', [EmailController::class, 'cambiar']);

//  RUTAS DE DOCTOR 
Route::get('doctor/agenda',DoctorAgenda::class)->name('agenda');
Route::get('doctor/crear-horarios', Crearhoras::class)->name('crear-horarios');

// RUTAS DE AGENDA CONSULTORIO
// Route::get('consultorio/agenda',[ConsultorioController::class,'agenda']);

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
