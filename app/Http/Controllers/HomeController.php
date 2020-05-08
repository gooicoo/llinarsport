<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Comentario;
use App\Respuesta;

class HomeController extends Controller
{
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
        $user = Auth::user();
        $comentarios = Comentario::orderBy('created_at','DESC')->paginate(6);
        return view( 'muro.muro' , compact('comentarios') )
              ->with( 'registrado', $user )
              ->with( 'respuestas', Respuesta::orderBy('created_at','DESC')->get() )
        ;
    }
}
