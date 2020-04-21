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

Route::get('muro', 'MuroController@index')->name('muro.index');  // ->middleware('auth');

Route::get('horasExtras', 'HorasExtrasController@index')->name('horasExtras.horasExtras');  // ->middleware('auth');
