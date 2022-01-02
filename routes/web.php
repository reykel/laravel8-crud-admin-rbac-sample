<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\FacultadesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;

/*
Route::resource('articulos', 'App\Http\Controllers\ArticuloController')->names('articulos');
Route::resource('cursos', 'App\Http\Controllers\CursosController')->names('cursos');
Route::resource('facultades', 'App\Http\Controllers\FacultadesController')->names('facultades');
Route::resource('users', 'App\Http\Controllers\UserController')->names('users');
*/


Route::group(['middleware' => ['auth']], function(){
    Route::resource('articulos', ArticuloController::class);
    Route::resource('cursos', CursosController::class);
    Route::resource('facultades', FacultadesController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RolController::class);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('getProducto/{id}', function ($id) {
    $producto = App\Models\Producto::where('id_categoria',$id)->get();
    return response()->json($producto);
});

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('auth.login');
});
*/
