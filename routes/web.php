<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/prueba', [App\Http\Controllers\prueba_controlador::class, 'index'])->name('prueba');
Route::get('/repuestos', [App\Http\Controllers\prueba_controlador::class, 'repuestos'])->name('repuestos');
Route::get('/repuesto/{id}', [App\Http\Controllers\prueba_controlador::class, 'repuesto'])->name('repuesto');
Route::get('/contacto', [App\Http\Controllers\prueba_controlador::class, 'contacto'])->name('contacto');
Route::get('/busqueda_por_modelo/{modelo}/{familia}', [App\Http\Controllers\prueba_controlador::class, 'busqueda_por_modelo'])->name('busqueda_por_modelo');
Route::get('/busqueda_por_oem/{oem}', [App\Http\Controllers\prueba_controlador::class, 'busqueda_por_oem']);
Route::get('/marcas-repuestos', [App\Http\Controllers\prueba_controlador::class, 'damemarcas'])->name('marcas');
Route::get('/carrito',[App\Http\Controllers\prueba_controlador::class, 'carrito'])->middleware('auth');
Route::post('/agregar_carrito',[App\Http\Controllers\prueba_controlador::class, 'agregar_carrito']);
Route::get('/revisar_carrito',[App\Http\Controllers\prueba_controlador::class, 'revisar_carrito']);
Route::post('/eliminar_item_carrito',[App\Http\Controllers\prueba_controlador::class, 'eliminar_item_carrito']);
Route::get('/modelos_marca/{id}',[App\Http\Controllers\prueba_controlador::class, 'modelos_marca']);
Route::get('/repuestos_modelo/{id}',[App\Http\Controllers\prueba_controlador::class, 'repuestos_modelo']);
Route::get('/quienes-somos',[App\Http\Controllers\prueba_controlador::class, 'quienes_somos']);

Route::post('/iniciar_pago',[App\Http\Controllers\transbank_controlador::class, 'index']);
Route::post('/confirmar_pago',[App\Http\Controllers\transbank_controlador::class, 'confirmar_pago'])->name('confirmar_pago');