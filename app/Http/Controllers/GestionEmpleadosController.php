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
        $empleados = User::all();
        return view('gestionEmpleados.index')->with('empleados',$empleados);;
    }

}
