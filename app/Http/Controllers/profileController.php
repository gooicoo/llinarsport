<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actividad_has_Users;
use App\Actividad;
use App\User;

class profileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $has_actividad = Actividad_has_Users::all();
        $actividad = Actividad::all();
        return view('profile')->with('registrado', $user)->with('has_actividades', $has_actividad)->with('actividades', $actividad);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $empleado = User::find($user->id);

        $empleado->email = $request->email;
        $empleado->password = Hash::make($request->password);

        $empleado->push();

        return redirect('profile');
    }

    public function añadirActividad(Request $request)
    {
        $user = Auth::user();
        $actividad = new Actividad_has_Users();

        $actividad->fk_users_id = $user->id;
        $actividad->fk_actividad_id = $request->actividad;

        $actividad->save();

        return redirect('profile');
    }

    public function borrarActividad(Request $request)
    {
      
        return redirect('profile');
    }



}
