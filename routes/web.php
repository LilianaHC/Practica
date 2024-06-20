<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FormasPagoController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CarritoController;


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

Route::get('/', function () {
    return view('index');
})->middleware('auth');

Route::resource('perfiles', PerfilesController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('facturas', FacturaController::class);
Route::resource('formaspago', FormasPagoController::class);
Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Rutas carrito de compra
//se sustituyerom las rutas de la version laravel 4 por una de laravel 10
//Route::get('carrito', ['as'=>'carrito', 'uses'=>'CarritoController@show']);
Route::get('carrito', [CarritoController::class, 'show'])->name('carrito');

Route::resource('productos',ProductosController::class);


//Route::get('carrito/agregar/{id}', ['as'=>'carrito-agregar', 'uses'=>'CarritoController@add']);
Route::get('carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito-agregar');

//Rutas carrito de compra
//se sustituyerom las rutas de la version laravel 4 por una de laravel 10
//Route::get('carrito', ['as'=>'carrito', 'uses'=>'CarritoController@show']);
Route::get('carrito', [CarritoController::class, 'show'])->name('carrito');

//Route::get('carrito/agregar/{id}', ['as'=>'carrito-agregar', 'uses'=>'CarritoController@add']);
Route::get('carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito-agregar');

//Route::get('carrito/borrar/{id}', ['as'=>'carrito-borrar', 'uses'=>'CarritoController@delete']);
Route::get('carrito/borrar/{id}', [CarritoController::class, 'delete'])->name('carrito-borrar');

//Route::get('carrito/vaciar', ['as'=>'carrito-vaciar', 'uses'=>'CarritoController@trash']);
Route::get('carrito/vaciar', [CarritoController::class, 'trash'])->name('carrito-vaciar');

//Route::get('carrito/actualizar/{id}/{cantidad?}', ['as'=>'carrito-actualizar', 'uses'=>'CarritoController@update']);
Route::get('carrito/actualizar/{id}/{cantidad?}', [CarritoController::class, 'update'])->name('carrito-actualizar');

//Route::get('ordenar', ['as'=>'ordenar', 'uses'=>'CarritoController@guardarPedido']);
Route::get('ordenar', [CarritoController::class, 'guardarPedido'])->name('ordenar');