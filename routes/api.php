<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Mensaje;
use App\Comunicados;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('mensajes', function(){
    $mensaje = mensaje::orderBy('fecha','desc')->limit(50)->get();
	return json_encode($mensaje);
});

Route::get('horario', 'API\HorarioApi@eventosHorario');

Route::get('comunicados', function(){
    $comunicados = Comunicados::orderBy('fecha','desc')->get();
	  return json_encode($comunicados);
});
