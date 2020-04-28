<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comunicados;

class comunicadosController extends Controller
{
    //
    public function index()
    {
        return view('comunicados')->with('comunicados', Comunicados::all());
    }
}
