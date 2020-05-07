<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Eventos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HorarioApi extends Controller {

      public function eventosHorario()
      {
            $dbEbentos = Eventos::all();

            if (is_null($dbEbentos)) {
                $response = [
                    'success' => false,
                    'data' => 'Empty',
                    'message' => 'No data found'
                ];
                return response()->json($response, 404);
            } else {
                $response = [
                    'success' => true,
                    'data' => $dbEbentos,
                    'message' => 'Todos los eventos'
                ];
                return response()->json($response, 200);
            }
      }





}
