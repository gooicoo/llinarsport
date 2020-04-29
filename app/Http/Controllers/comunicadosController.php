<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comunicados;
use App\User;

class comunicadosController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        return view('comunicados')->with('comunicados', Comunicados::all())->with('users', User::all())->with('registrado', $user);;
    }

    public function create(Request $request){
        $user = Auth::user();
        $comunicado = new Comunicados();

        $comunicado->fk_users_id = $user->id;
        $comunicado->fecha = date('Y-m-d');
        $comunicado->asunto = $request->asunto;
        $comunicado->descripcion = $request->descripcion;
        $comunicado->fk_user_remitente = $request->Remitente;
        $comunicado->fk_user_sustitucion = $request->Sustituto;


        $comunicado->save();

        return redirect('comunicados');
    }

    public function reply(Request $request)
    {
        $comunicado = Comunicados::find($request->id);

        $comunicado->respuesta = $request->respuesta;


        $comunicado->save();

        return redirect('comunicados');
    }
}
