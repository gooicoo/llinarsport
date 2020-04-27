<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actividad_has_Users;
use App\User;

class profileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $actividad = Actividad_has_Users::all();
        return view('profile')->with('registrado', $user)->with('actividades', $actividad);
    }

    public function update(Request $request)
    {
        $empleado = User::find($request->dni);

        $empleado->email = $request->email;
        $empleado->password = Hash::make($request->password);
        
        $empleado->push();

        return redirect('profile');
    }
}
