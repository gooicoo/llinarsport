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
                return View('horasExtras.empleado')->with('horas', Horas_extra::all()->where('fk_users_id', $user -> id))->with('actividades', $actividad);
                break;
            case '2':
                return View('horasExtras.departamento')->with('horas', Horas_extra::all()->where('fk_department_id', $user -> fk_department_id));
                break;
            case '3':
                return View('horasExtras.instalacion')->with('horas',Horas_extra::all()->where('fk_instalacion_id', $user -> fk_instalacion_id));
                break;
            case '4':
                return View('horasExtras.tesorero')->with('horas',Horas_extra::all());
                break;    
        }
    }
    public function update($id){
        Horas_extra::where('id', $id)->update(['estado' => 1]);


        return redirect('/horasExtra.index');
    }


}
