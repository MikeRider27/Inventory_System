<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SucursalesController;

Route::get('/', function () {
    return view('modules.users.login');
})->name('/');

Route::get('/home', function () {
    return view('modules.home');
});

//Route::get('First-User', [UsersController::class, 'FirstUser']);

Auth::routes();

//Sucursales
Route::get('Sucursales', [SucursalesController::class, 'index']);
Route::post('Sucursales', [SucursalesController::class, 'store']);
Route::get('Editar-Sucursal/{id_sucursal}', [SucursalesController::class, 'edit']);
Route::put('Actualizar-Sucursal', [SucursalesController::class, 'update']);
Route::get('Cambiar-Estado-Sucursal/{estado}/{id_sucursal}', [SucursalesController::class, 'CambiarEstado']);

//Users
Route::get('Perfil', function () {
    return view('modules.users.perfil');
});
Route::post('Perfil', [UsersController::class, 'ActualizarPerfil']);
Route::get('Usuarios', [UsersController::class, 'index']);
Route::post('Usuarios', [UsersController::class, 'store']);
Route::get('Cambiar-Estado-Usuario/{id_usuario}/{estado}', [UsersController::class, 'CambiarEstado']);