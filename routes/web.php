<?php

use App\Http\Controllers\PermisoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\PDTController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Makecccccccccc something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::get('/setup', function () {
    $credentials=[
        'email' => "admin@admin.com",
        'password' => 'password'
    ];
    if(!Auth::attempt($credentials)) {
        $user = new \App\Models\User();
        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();
    }
    if(Auth::attempt($credentials)){
        $user = Auth::user();
        $adminToken = $user->createToken('admin-token',['create', 'update', 'delete']);
        $updateToken = $user->createToken('update-token',['create', 'update']);
        $basicToken = $user->createToken('basic-token');
        return [
            'admin' => $adminToken->plainTextToken,
            'update' => $updateToken->plainTextToken,
            'basic' => $basicToken->plainTextToken,
        ];
    }
});

Route::middleware(['auth'])->group(function () {

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::resource('clientes', ClienteController::class);
Route::resource('asesores', AsesorController::class);
Route::resource('plandework', PDTController::class);
Route::resource('proyectos', ProyectosController::class);


Route::middleware(['auth', 'can:Admin Configuracion'])->group(function () {
Route::resource('roles', RoleController::class);
Route::resource('permisos', PermisoController::class);
Route::resource('usuarios', AsignarController::class)->names('asignar');
Route::resource('users', UserController::class);
Route::post('/create-all-permisos', [PermisoController::class, 'createAllPermisos'])->name('create-all-permisos');
});

Route::get('proyectos', [ProyectosController::class, 'index'])->name('proyectos.index');
Route::get('proyectos.create', [ProyectosController::class, 'create'])->name('proyectos.create');
Route::post('proyectos', [ProyectosController::class, 'store'])->name('proyectos.store');
Route::get('proyectos/{id}', [ProyectosController::class, 'show'])->name('proyectos.show');
Route::post('/proyectos/{proyectoId}/update-progress/{progreso}', [ProyectosController::class, 'updateProgress']);


Route::get('proyectos/{id}/plandework/', [PDTController::class, 'show'])->name('proyectos.plandework.show');
Route::get('proyectos/{id}/plandework/create', [PDTController::class, 'create'])->name('proyectos.plandework.create');
Route::post('proyectos/{id}/plandework', [PDTController::class, 'store'])->name('proyectos.plandework.store');
Route::delete('/plandetrabajo/{id}', [PDTController::class, 'destroy'])->name('plandetrabajo.destroy');

Route::get('proyectos/evidencia/{id}', [ProyectosController::class, 'showProyecto'])->name('proyectos.evidencia.show');

// Rutas para Evidencias
Route::post('proyectos/evidencia/{id}/upload', [ProyectosController::class, 'uploadFiles'])->name('proyectos.evidencia.uploadFiles');
Route::get('proyectos/evidencia/{id}/download', [ProyectosController::class, 'downloadFile'])->name('proyectos.evidencia.downloadFile');
Route::get('proyectos/descargar-archivo/{id}', [ProyectosController::class, 'downloadFile'])->name('proyectos.archivos.downloadFile');
Route::get('proyectos/archivos/delete/{id}', [ProyectosController::class, 'deleteFile'])->name('proyectos.archivos.deleteFile');
Route::get('proyectos/archivos/{archivosId}', [ProyectosController::class, 'showFiles'])->name('proyectos.archivos.showFiles');


});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
