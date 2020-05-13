<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Actividad;

class GestionActividadesController extends Controller {

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
        return view('gestionActividades.actividades')
            ->with('actividades', Actividad::all())
        ;
    }

    public function create(Request $request)
    {
       $actividad = new Actividad();
       $actividad->nombre = $request->nombre;
       $actividad->precio = $request->precio;

       $actividad->save();

       return redirect('gestionActividades')->with('notice', 'La actividad se ha creado');;
    }

    public function edit(Request $request)
    {
        $actividad = Actividad::find($request->id);

        $actividad->nombre = $request->nombre;
        $actividad->precio = $request->precio;

        $actividad->save();

        return redirect('gestionActividades')->with('notice','La actividad se ha editada');
    }

    public function destroy(Request $request)
    {
      Actividad::find($request->id)->delete();
      return redirect('gestionActividades')->with('notice', 'La actividad se ha eliminado');
    }



}
