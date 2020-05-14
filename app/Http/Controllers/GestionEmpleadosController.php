<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function index(Request $request)
    {
        $user = Auth::user();
        $buscarEmpleado = $request->get('buscarEmpleado');
        $buscarDepartamento = $request->get('buscarDepartamento');

        switch ($user -> fk_role_id){
            case '2':
                return view('gestionEmpleados.departamento')
                        ->with( 'registrado', $user )
                        ->with('empleados', User::orderBy('fk_role_id','DESC')->get() )
                        ->with('departamentos', Departamento::all() )
                        ->with('instalaciones', Instalacion::all() );
                break;
            case '3':
                if ($buscarEmpleado) {
                    $empleados = User::where('id', $buscarEmpleado)->orderBy('fk_departamento_id','ASC')->orderBy('fk_role_id','DESC')->paginate(10);
                }elseif ($buscarDepartamento) {
                    $empleados = User::where('fk_departamento_id', $buscarDepartamento)->orderBy('fk_role_id','DESC')->paginate(10);
                }else{
                    $empleados = User::orderBy('fk_departamento_id','ASC')->orderBy('fk_role_id','DESC')->paginate(10);
                }

                return view('gestionEmpleados.gestion', compact('empleados'))
                        ->with('departamentos' , Departamento::all())
                        ->with('roles' , Role::all())
                        ->with('instalaciones' , Instalacion::all());
                break;
        }
    }

    public function create(Request $request)
    {
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

       return redirect('gestionEmpleados')->with('notice', 'El empleado se ha creado');
    }

    public function destroy(Request $request)
    {
      User::find($request->id)->delete();
      return redirect('gestionEmpleados')->with('notice', 'El empleado se ha eliminado');
    }



}
