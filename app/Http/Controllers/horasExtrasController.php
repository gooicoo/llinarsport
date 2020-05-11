<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Horas_extra;
use App\Actividad;
use App\Departamento;
use App\Instalacion;
use DB;

class horasExtrasController extends Controller {

    public function index() {
        $user = Auth::user();

        switch ($user -> fk_role_id){
            case '1':
                return View('horasExtras.empleado')
                      ->with('horas', Horas_extra::orderBy('fk_departamento_id','ASC')->orderBy('fecha','ASC')->get())
                      ->with('actividades', Actividad::all())
                      ->with('departamentos', Departamento::all())
                      ->with('instalaciones', Instalacion::all())
                      ->with('registrado', $user);
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

        return redirect('horasExtras')->with('notice','Has confirmado las horas del empleado '.$request->name);
    }

    public function create(Request $request){

        $user = Auth::user();
        $extra = new Horas_extra();

        $extra->fecha = $request->dia;
        $extra->hora_inicio = $request->inicio;
        $extra->hora_fin = $request->fin;
        $extra->hora_total = $request->total;
        $extra->motivo = $request->motivo;
        $extra->dia_festivo = $request->festivo;
        $extra->hora_nocturna = $request->nocturna;
        $extra->compensar = $request->compensar;
        $extra->fk_users_id = $user->id;
        $extra->fk_departamento_id = $request->departamento;
        $extra->fk_instalacion_id = $request->instalacion;
        $extra->fk_actividad_id = $request->actividad;

        $extra->save();

        return redirect('horasExtras');
    }

    public function edit(Request $request)
    {
        $extra = Horas_extra::find($request->id);

        $extra->fecha = $request->dia;
        $extra->hora_inicio = $request->inicio;
        $extra->hora_fin = $request->fin;
        $extra->hora_total = $request->total;
        $extra->motivo = $request->motivo;
        $extra->dia_festivo = $request->festivo;
        $extra->hora_nocturna = $request->nocturna;
        $extra->compensar = $request->compensar;
        $extra->fk_departamento_id = $request->departamento;
        $extra->fk_instalacion_id = $request->instalacion;
        $extra->fk_actividad_id = $request->actividad;

        $extra->save();

        return redirect('horasExtras');
    }



    public function destroy(Request $request)
    {
      Horas_extra::find($request->id)->delete();
      return redirect('horasExtras')->with('notice', 'La hora extra se ha eliminado');
    }

}
