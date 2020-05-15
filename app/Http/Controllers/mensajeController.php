<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mensaje;

class mensajeController extends Controller
{
    public function index(){
        return View('mensaje')->with('users', User::all());
    }

    public function store(Request $request){
        $datosMensaje = request()->except(['_token','_method']);
        Mensaje::insert($datosMensaje);
        print_r($datosMensaje);
    }
}
