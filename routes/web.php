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
    return view('auth.login');
});

Auth::routes();
Route::get('home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('muro', 'MuroController@index')->name('muro.muro')->middleware('auth');
Route::get('horasExtras', 'HorasExtrasController@index')->middleware('auth');

Route::get('gestionEmpleados', 'GestionEmpleadosController@index')->name('gestion')->middleware('auth');
