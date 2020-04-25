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
        $empleados = User::orderBy('fk_departamento_id','ASC')->get();
        $departamentos = Departamento::all();
        $roles = Role::all();
        $instalaciones = Instalacion::all();
        return view('gestionEmpleados.gestion')->with('empleados',$empleados)->with('departamentos',$departamentos)->with('roles',$roles)->with('instalaciones',$instalaciones);
    }

    public function create()
    {


    }

  


}
