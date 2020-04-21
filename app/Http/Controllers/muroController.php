<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class muroController extends Controller {

    public function index() {
        return view('muro.index');
    }


}
