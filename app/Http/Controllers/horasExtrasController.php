<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class horasExtrasController extends Controller {

    public function index() {
        $user = Auth::user();
        
        switch ($user -> fk_role_id){
            case '1':
                return View('horasExtras.empleado');
                break;
            case '2':
                return View('horasExtras.departamento');
                break;
            case '3':
                return View('horasExtras.instalacion');
                break;
            case '4':
                return View('horasExtras.tesorero');
                break;    
        }
    }


}
