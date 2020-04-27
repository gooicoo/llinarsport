<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\User;
use App\Departamento;
use App\Role;
use App\Instalacion;

class GestionEmpleadosController extends Controller {

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empleados = User::orderBy('fk_departamento_id','ASC')->orderBy('fk_role_id','DESC')->get();
        $departamentos = Departamento::all();
        $roles = Role::all();
        $instalaciones = Instalacion::all();
        return view('gestionEmpleados.gestion')
                ->with('empleados',$empleados)
                ->with('departamentos',$departamentos)
                ->with('roles',$roles)
                ->with('instalaciones',$instalaciones);
    }

    public function create(Request $request)
    {
       $user = new User();
       $user->dni = $request->dni;
       $user->name = $request->name;
       $user->apellido = $request->apellido;
       $user->email = $request->mail;
       $user->password = $request->password;
       $user->fk_role_id = $request->role;
       $user->fk_departamento_id = $request->departamento;
       $user->fk_instalacion_id = $request->instalacion;

       $user->save();

       return redirect('gestionEmpleados');
    }

    public function destroy(Request $request)
    {
      User::find($request->id)->delete();
      return redirect('gestionEmpleados')->with('notice', 'El empleado se ha eliminado');
    }



}
