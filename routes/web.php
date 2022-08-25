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