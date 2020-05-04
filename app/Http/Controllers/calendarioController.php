<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Eventos;

class calendarioController extends Controller
{
    //
    public function index() {
        $user = Auth::user();

        switch ($user -> fk_role_id){
            case '1':
                return View('calendario.empleado')->with('eventos',Eventos::all());
                break;
            case '2':
                return View('calendario.departamento');
                break;
        }
    }

    public function create(Request $request)
    {
        $evento = new Eventos();
        $evento->titulo = $request->titulo;
        $evento->description = $request->descripcion;
        $evento->inicio = $request->inicio;
        $evento->fin = $request->fin;

        $evento->save();

        return redirect('calendario');
    }

    public function show()
    {
        $data['events'] = Eventos::all();
        return response()->json($data['events']);
    }
}
