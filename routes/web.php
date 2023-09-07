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
use App\Http\Livewire\AsigPerm;
use App\Http\Livewire\CalendarioDoctor;
use App\Http\Livewire\Cambiarpass;
use App\Http\Livewire\Crearconsultorio;
use App\Http\Livewire\Crearhoras;
use App\Http\Livewire\CrearPosts;
use App\Http\Livewire\CreateRol;
use App\Http\Livewire\CreatPermission;
use App\Http\Livewire\DoctorAgenda;
use App\Http\Livewire\EditarImporte;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Registro;
use App\Http\Livewire\RegistroDoctor;
use App\Http\Livewire\Reservar;
use App\Http\Livewire\ReservarAdmin;
use App\Http\Livewire\ShowDoctorDescrip;
use App\Http\Livewire\Showposts;
use App\Http\Livewire\TurnosReservados;
use App\Models\CalendarioDetalles;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Commands\CreatePermission;
use Spatie\Permission\Models\Role;

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

Route::get('/home', HomeController::class)->middleware(
   [ 'auth:sanctum',config('jetstream.auth_session'),
   'verified']);
Route::get('/', function (){
    return view('index');
});
//  RUTAS DE PACIENTES
Route::middleware(['role:Paciente',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('paciente/profile', Profile::class)->name('profile');
    Route::get('paciente/turnos-reservados',TurnosReservados::class)->name('reservados');
});

Route::middleware(['role:Paciente|Invitado',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('paciente/reservar', Reservar::class)->name('reservar');
});

Route::get('paciente/registro', Registro::class)->name('registro');



// RUTAS ADM FUNCIONALIDADES
Route::middleware(['role:Admin',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('admfunc/registro-doctor', RegistroDoctor::class)->name('admin.registro-doctor');
    Route::get('admfunc/alta-doctor', AltaDoctor::class)->name('admin.alta-doctor');
    Route::get('admfunc/edit-importe', EditarImporte::class)->name('admin.edit');
    Route::get('admfunc/calendario-doctor', CalendarioDoctor::class )->name('admin.calendario');
    Route::get('admfunc/alta-reser-adm', AltaReservaAdmin::class)->name('admin.altaReser');
    Route::get('admfunc/crear-consult', Crearconsultorio::class)->name('admin.consulCreate');
    Route::get('admfunc/alta-consult', Altaconsultorio::class)->name('admin.consulAlt');
    Route::get('admfunc/reservar-adm',ReservarAdmin::class)->name('admin.reserva');
    Route::get('admfunc/create-rol', CreateRol::class)->name('admin.crear-rol');
    Route::get('admfunc/create-permission', CreatPermission::class)->name('admin.crear-permisos');
    Route::get('admfunc/asig-permission', AsigPerm::class)->name('admin.asig-permisos');
    Route::get('admfunc/crear-horarios', Crearhoras::class)->name('crear-horarios');
});


//  RUTAS DE POST

Route::middleware(['role:Admin|Blogger',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('post/crear', CrearPosts::class)->name('crear');
    Route::get('post/alta', AltaPost::class)->name('alta');
});



//  RUTAS COMUNES EN TODOS LOS USUARIOS
Route::middleware(['role:Admin|Blogger|Doctor|Paciente',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/cambiar-pass', Cambiarpass::class)->name('cambiar');
});


// Route::get('/cambiar-correo', [EmailController::class, 'cambiar']);

//  RUTAS DE DOCTOR 
Route::middleware(['role:Doctor',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('doctor/agenda',DoctorAgenda::class)->name('agenda');

});




// RUTAS DE AGENDA CONSULTORIO
// Route::get('consultorio/agenda',[ConsultorioController::class,'agenda']);

//  RUTAS DE ADMIN LTE TEMPLATE 
// Route::get('adm/dashboard', [AdmTempController::class,'dashboard']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('show-doc/{data}', ShowDoctorDescrip::class)->name('show-doc');


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
