<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use app\User;

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
        return view('gestionEmpleados.gestion')->with('empleados',$empleados);
    }

}
