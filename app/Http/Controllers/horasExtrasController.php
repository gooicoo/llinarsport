<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class horasExtrasController extends Controller {

    public function horasExtras() {
        return view('horasExtras.empleado');
        //return View('horasExtras.departamento');
        //return View('horasExtras.instalacion');
        //return View('horasExtras.tesorero');
        /*
        switch (Auth::usr()->role){
            case 'empleado':
                return View('horasExtras.empleado');
                break;
            case 'departamento':
                return View('horasExtras.departamento');
                break;
            case 'instalacion':
                return View('horasExtras.instalacion');
                break;
            case 'tesorero':
                return View('horasExtras.tesorero');
                break;
                
        }
        */
    }


}
