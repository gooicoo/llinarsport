<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Eventos;

class EventosController extends Controller
{
    //
    public function index() {

        return view('eventos')->with('eventos',Eventos::all());
    }

    public function store(Request $request)
    {
        $datosEvento = request()->except(['_token','_method']);
        Eventos::insert($datosEvento);
        print_r($datosEvento);
    }

    public function show()
    {
        $data['eventos'] = Eventos::all();
        print_r($data['events']);
        return response()->json($data['eventos']);
    }
}
