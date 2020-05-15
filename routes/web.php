<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('home', 'HomeController@index')->name('home')->middleware('auth');

//MURO
Route::get('muro', 'MuroController@index')->name('muro.muro')->middleware('auth');
Route::get('muro/pagination', 'MuroController@pagination')->name('muro.pagination')->middleware('auth');
Route::get('muro.createPost', 'MuroController@createPost')->name('muro.createPost')->middleware('auth');
Route::get('muro.createRespuesta', 'MuroController@createRespuesta')->name('muro.createRespuesta')->middleware('auth');

//HORAS EXTRAS
Route::get('horasExtras', 'HorasExtrasController@index')->middleware('auth')->name('horasExtras.index');
Route::get('horasExtras.update', 'HorasExtrasController@update')->name('horasExtras.update');
Route::get('horasExtras.create', 'HorasExtrasController@create')->name('horasExtras.create')->middleware('auth');
Route::get('horasExtras.edit', 'HorasExtrasController@edit')->name('horasExtras.edit')->middleware('auth');
Route::get('horasExtras.destroy', 'HorasExtrasController@destroy')->name('horasExtras.destroy')->middleware('auth');
Route::get('horasExtras.buscador', 'HorasExtrasController@buscador')->name('horasExtras.buscador')->middleware('auth');

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

//GESTION EMPLEADO
// Route::resource('gestionEmpleados', 'GestionEmpleadosController')->middleware('auth');
Route::get('gestionEmpleados', 'GestionEmpleadosController@index')->name('gestionEmpleados.index')->middleware('auth');
Route::get('gestionEmpleados.create', 'GestionEmpleadosController@create')->name('gestionEmpleados.create')->middleware('auth');
Route::get('gestionEmpleados.destroy', 'GestionEmpleadosController@destroy')->name('gestionEmpleados.destroy')->middleware('auth');

//GESTION ACTIVIDADES
Route::get('gestionActividades', 'GestionActividadesController@index')->middleware('auth');
Route::get('gestionActividades.create', 'GestionActividadesController@create')->name('gestionActividades.create')->middleware('auth');
Route::get('gestionActividades.edit', 'GestionActividadesController@edit')->name('gestionActividades.edit')->middleware('auth');
Route::get('gestionActividades.destroy', 'GestionActividadesController@destroy')->name('gestionActividades.destroy')->middleware('auth');

//CHAT
Route::resource('mensaje', 'MensajeController')->middleware('auth');
// Route::post('mensaje', 'MensajeController@index')->name('mensaje.index')->middleware('auth');
