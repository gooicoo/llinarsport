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

//MURO
Route::get('muro', 'MuroController@index')->name('muro.muro')->middleware('auth');

//HORAS EXTRAS
Route::get('horasExtras', 'HorasExtrasController@index')->middleware('auth')->name('horasExtras.index');
Route::get('horasExtras.update', 'HorasExtrasController@update')->name('horasExtras.update');
Route::get('horasExtras.create', 'HorasExtrasController@create')->name('horasExtras.create')->middleware('auth');
Route::get('horasExtras.edit', 'HorasExtrasController@edit')->name('horasExtras.edit')->middleware('auth');
Route::get('horasExtras.destroy', 'HorasExtrasController@destroy')->name('horasExtras.destroy')->middleware('auth');

//PROFILE
Route::get('profile', 'ProfileController@index')->middleware('auth');
Route::get('profile.update', 'ProfileController@update')->middleware('auth')->name('profile.update');
Route::get('profile.añadirActividad', 'ProfileController@añadirActividad')->middleware('auth')->name('profile.añadirActividad');
Route::get('profile.borrarActividad', 'ProfileController@borrarActividad')->middleware('auth')->name('profile.borrarActividad');

//COMUNICADOS
Route::get('comunicados', 'ComunicadosController@index')->middleware('auth')->name('comunicados.index');
Route::get('comunicados.create', 'ComunicadosController@create')->middleware('auth')->name('comunicados.create');
Route::get('comunicados.reply', 'ComunicadosController@reply')->middleware('auth')->name('comunicados.reply');

//CALENDARIO
Route::resource('calendario', 'CalendarioController')->middleware('auth');
// Route::get('calendario', 'CalendarioController@index')->middleware('auth')->name('calendario.index');
// Route::get('calendario.create', 'CalendarioController@create')->middleware('auth')->name('calendario.create');
// Route::get('calendario.show', 'CalendarioController@show')->middleware('auth')->name('calendario.show');

//GESTION EMPLEADO
// Route::resource('gestionEmpleados', 'GestionEmpleadosController')->middleware('auth');
Route::get('gestionEmpleados', 'GestionEmpleadosController@index')->name('gestionEmpleados.index')->middleware('auth');
Route::get('gestionEmpleados.create', 'GestionEmpleadosController@create')->name('gestionEmpleados.create')->middleware('auth');
Route::get('gestionEmpleados.destroy', 'GestionEmpleadosController@destroy')->name('gestionEmpleados.destroy')->middleware('auth');
