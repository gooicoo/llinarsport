<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class calendarioController extends Controller
{
    //
    public function index() {
        $user = Auth::user();

        switch ($user -> fk_role_id){
            case '1':
                return View('calendario.empleado');
                break;
            case '2':
                return View('calendario.departamento');
                break;
        }
    }
}