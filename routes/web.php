<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HomeController;



Route::get('/', function () {
    return view('modules.users.login');
})->name('/');

Route::get('home', [HomeController::class, 'index']);

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
Route::get('Editar-Usuario/{id_usuario}', [UsersController::class, 'edit']);
Route::post('Verificar-Usuario', [UsersController::class, 'VerificarUsuario']);
Route::put('Actualizar-Usuario', [UsersController::class, 'update']);
Route::get('Eliminar-Usuario/{id_usuario}', [UsersController::class, 'destroy']);

//Categorias
Route::get('Categorias', [CategoriasController::class, 'index']);
Route::post('Categorias', [CategoriasController::class, 'store']);
Route::get('Editar-Categoria/{id_categoria}', [CategoriasController::class, 'edit']);
Route::put('Actualizar-Categoria', [CategoriasController::class, 'update']);
Route::get('Eliminar-Categoria/{id_categoria}', [CategoriasController::class, 'destroy']);

//Productos
Route::get('Productos', [ProductosController::class, 'index']);
Route::get('Generar-Codigo-Producto/{id_categoria}', [ProductosController::class, 'GenerarCodigo']);
Route::post('Productos', [ProductosController::class, 'store']);
Route::get('Editar-Producto/{id_producto}', [ProductosController::class, 'edit']);
Route::put('Actualizar-Producto', [ProductosController::class, 'update']);
Route::get('Eliminar-Producto/{id_producto}', [ProductosController::class, 'destroy']);

//Clientes
Route::get('Clientes', [ClientesController::class, 'index']);
Route::post('Clientes', [ClientesController::class, 'store']);
Route::post('Validar-Documento', [ClientesController::class, 'ValidarDocumento']);
