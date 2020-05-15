<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidarFormularios;
use App\User;
use App\Horas_extra;
use App\Actividad;
use App\Departamento;
use App\Instalacion;
use DB;

class horasExtrasController extends Controller {

    public function index(Request $request) {
        $user = Auth::user();

        $fechaInicio = $request->get('buscarFechaInicio');
        $fechaFin = $request->get('buscarFechaFin');
        $buscarEmpleado = $request->get('buscarEmpleado');

        switch ($user -> fk_role_id){
            case '1':
                if ($fechaInicio) {
                    $horas = Horas_extra::whereBetween('fecha',[$fechaInicio,$fechaFin])->where('fk_users_id',$user->id)->orderBy('fk_departamento_id','DESC')->orderBy('fecha','DESC')->paginate(6);
                }else{
                    $horas = Horas_extra::where('fk_users_id',$user->id)->orderBy('fk_departamento_id','ASC')->orderBy('fecha','DESC')->paginate(6);
                }

                return View('horasExtras.empleado',compact('horas'))
                      ->with('actividades', Actividad::all())
                      ->with('departamentos', Departamento::all())
                      ->with('instalaciones', Instalacion::all())
                      ->with('registrado', $user);
                break;

            case '2':
                if ($fechaInicio && $fechaFin && $buscarEmpleado) {
                    $horas = Horas_extra::whereBetween('fecha',[$fechaInicio,$fechaFin])->where('fk_users_id', $buscarEmpleado)->where('fk_departamento_id',$user->fk_departamento_id)->where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }elseif ($fechaInicio && $fechaFin) {
                    $horas = Horas_extra::whereBetween('fecha',[$fechaInicio,$fechaFin])->where('fk_departamento_id',$user->fk_departamento_id)->where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }elseif ($buscarEmpleado) {
                    $horas = Horas_extra::where('fk_users_id', $buscarEmpleado)->where('fk_departamento_id',$user->fk_departamento_id)->where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }else{
                    $horas = Horas_extra::where('fk_departamento_id',$user->fk_departamento_id)->where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }

                return View('horasExtras.departamento', compact('horas'))
                      ->with('empleados', User::where('fk_departamento_id',$user->fk_departamento_id)->where('fk_instalacion_id',$user->fk_instalacion_id)->where('fk_role_id','1')->get())
                      ->with('registrado', $user);
                break;

            case '3':
                if ($fechaInicio && $fechaFin && $buscarEmpleado) {
                    $horas = Horas_extra::whereBetween('fecha',[$fechaInicio,$fechaFin])->where('fk_users_id', $buscarEmpleado)->where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }elseif ($fechaInicio && $fechaFin) {
                    $horas = Horas_extra::whereBetween('fecha',[$fechaInicio,$fechaFin])->where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }elseif ($buscarEmpleado) {
                    $horas = Horas_extra::where('fk_users_id', $buscarEmpleado)->where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }else{
                    $horas = Horas_extra::where('fk_instalacion_id',$user->fk_instalacion_id)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }

                return View('horasExtras.instalacion', compact('horas'))
                      ->with('empleados', User::where('fk_instalacion_id',$user->fk_instalacion_id)->where('fk_role_id','1')->get())
                      ->with('registrado', $user);
                break;

            case '4':
                if ($fechaInicio && $fechaFin && $buscarEmpleado) {
                    $horas = Horas_extra::whereBetween('fecha',[$fechaInicio,$fechaFin])->where('fk_users_id', $buscarEmpleado)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }elseif ($fechaInicio && $fechaFin) {
                    $horas = Horas_extra::whereBetween('fecha',[$fechaInicio,$fechaFin])->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }elseif ($buscarEmpleado) {
                    $horas = Horas_extra::where('fk_users_id', $buscarEmpleado)->orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }else{
                    $horas = Horas_extra::orderBy('fk_users_id','ASC')->orderBy('fecha','ASC')->paginate(6);
                }

                return View('horasExtras.tesorero', compact('horas'))
                      ->with('empleados', User::where('fk_role_id','1')->get())
                      ->with('registrado', $user);
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

        return redirect('horasExtras')->with('notice','Has creado un registro');
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

        return redirect('horasExtras')->with('notice','Has editado un registro');
    }



    public function destroy(Request $request)
    {
        Horas_extra::find($request->id)->delete();
        return redirect('horasExtras')->with('notice', 'La hora extra se ha eliminado');
    }

    public function buscador(Request $request)
    {
        $dia = Horas_extra::where('fecha','like','%-'.$request->texto.'-%')->take(10)->get();
        return redirect('horasExtras',compact('dia'));
    }

}
