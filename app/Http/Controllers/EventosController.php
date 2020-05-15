<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Eventos;

class EventosController extends Controller
{
    //
    public function index() {
        $user = Auth::user();

        switch ($user -> fk_role_id){
            case '1':
                return view('calendario.empleado')->with('eventos',Eventos::all());
                break;
            case '2':
                return view('calendario.departamento');
                break;
        }
    }

    public function store(Request $request)
    {
        $datosEvento = request()->except(['_token','_method']);
        Eventos::insert($datosEvento);
        print_r($datosEvento);
    }

    public function show()
    {
        $data['eventos'] = Eventos::all();
        // print_r($data['eventos']);
        return response()->json($data['eventos']);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $datosEvento = request()->except(['_token','_method']);
        $respuesta = Eventos::where('id','=',$id)->update($datosEvento);
        return response()->json($respuesta);
    }

    public function destroy($id)
    {
        $datosEvento = Eventos::findOrFail($id);
        Eventos::destroy($id);
        return response()->json($id);
    }
}
