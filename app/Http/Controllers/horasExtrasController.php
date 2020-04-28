<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Horas_extra;
use App\Actividad;
use DB;

class horasExtrasController extends Controller {

    public function index() {
        $user = Auth::user();
        $actividad = Actividad::all();

        switch ($user -> fk_role_id){
            case '1':
                return View('horasExtras.empleado')->with('horas', Horas_extra::all())->with('actividades', $actividad)->with('registrado', $user);
                break;
            case '2':
                return View('horasExtras.departamento')->with('horas', Horas_extra::all())->with('registrado', $user);
                break;
            case '3':
                return View('horasExtras.instalacion')->with('horas',Horas_extra::all())->with('registrado', $user);
                break;
            case '4':
                return View('horasExtras.tesorero')->with('horas',Horas_extra::all());
                break;
        }
    }

    public function update(Request $request){
        $extra = Horas_extra::find($request->id);
        $user = Auth::user();

        switch ($user -> fk_role_id){
            case '1':
                $extra->estado = 0;
                break;
            case '2':
                $extra->estado = 1;
                break;
            case '3':
                $extra->estado = 2;
                break;
            case '4':
                $extra->estado = 3;
                break;
        }
        $extra->push();

        return redirect('horasExtras');
    }

    public function create(Request $request){

        $user = new User();
        $user->dni = $request->dni;
        $user->name = $request->name;
        $user->apellido = $request->apellido;
        $user->email = $request->mail;
        $user->password = Hash::make($request->password);
        $user->fk_role_id = $request->role;
        $user->fk_departamento_id = $request->departamento;
        $user->fk_instalacion_id = $request->instalacion;

        $user->save();

        return redirect('gestionEmpleados');

    }

}
