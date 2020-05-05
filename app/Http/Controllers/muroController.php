<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Comentario;
use App\Respuesta;

class muroController extends Controller {

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
        $comentario = Comentario::orderBy('created_at','DESC')->>get();

        return view( 'muro.muro' )
              ->with( 'registrado', $user )
              ->with( 'comentarios', $comentario )
              ->with( 'respuestas', Respuesta::orderBy('created_at','DESC')->get() )
        ;

    }

    public function createPost(Request $request)
    {
      $user = Auth::user();
      $post = new Comentario();

      $post->fk_users_id = $user->id;
      $post->asunto = $request->asunto;
      $post->mensaje = $request->mensaje;

      $post->save();

      return redirect('muro');
    }

    public function createRespuesta(Request $request)
    {
      $user = Auth::user();
      $post = new Respuesta();

      $post->mensaje = $request->respuesta;
      $post->fk_users_id = $user->id;
      $post->fk_comentario_id = $request->comentario_id;

      $post->save();

      return redirect('muro');
    }

}
