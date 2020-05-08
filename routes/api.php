<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Mensaje;
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
    $mensaje = mensaje::orderBy('created_at','desc')->limit(20)->get();
	return json_encode($mensaje);
});

Route::get('horario', 'API\HorarioApi@eventosHorario');

