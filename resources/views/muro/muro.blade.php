@extends('layouts.template')

@section('title')
  Muro
@endsection

@section('body')
	<div class="comments-container comments-list">
		<h1>Muro</h1>
    <div class="comment-main-level">
      <div class="comment-avatar"><img src="" alt=""></div>
      <div class="comment-box">
        <div class="comment-head">
          <h6 class="comment-name">{{ $registrado->name }}</h6>
        </div>
        <div class="comment-content nuevo-post">
          <form class="" action="{{ route('muro.createPost') }}" method="GET">
            <input class="col-md-12 form-control" type="text" name="asunto" placeholder="Escribe el asunto">
            <textarea class="col-md-12 form-control" name="mensaje" rows="2" placeholder="Escribe el post"></textarea>
            <button type="submit" class="btn btn-primary btn-muro">Publicar</button>
          </form>
        </div>
      </div>
    </div>
		<div id="comments-list" class="comments-list">
      @foreach($comentarios as $comentario)
        <hr>
  			<li>
  				<div class="comment-main-level">
  					<div class="comment-avatar"><img src="" alt=""></div>
  					<div class="comment-box">
  						<div class="comment-head">
  							<h6 class="comment-name">{{$comentario->user->name}}</h6>
  							<span>{{ $comentario->created_at->format('d/m/Y - H:i:s') }}</span>
  						</div>
  						<div class="comment-content">
                <h5>{{ $comentario->asunto }}</h5>
  							{{ $comentario->mensaje }}
  						</div>
  					</div>
  				</div>
  				<!-- Respuestas de los comentarios -->
          @foreach( $respuestas as $respuesta )
            @if( $comentario->id == $respuesta->fk_comentario_id )
      				<ul class="comments-list reply-list">
      					<li>
      						<div class="comment-avatar"><img src="" alt=""></div>
      						<div class="comment-box">
      							<div class="comment-head">
      								<h6 class="comment-name">{{$respuesta->user->name}}</h6>
      								<span>{{ $respuesta->created_at->format('d/m/Y - H:i:s') }}</span>
      							</div>
      							<div class="comment-content">
                      {{ $respuesta->mensaje }}
      							</div>
      						</div>
      					</li>
      				</ul>
            @endif
          @endforeach
            <ul class="comments-list reply-list">
              <li>
                <div class="comment-avatar"><img src="" alt=""></div>
                <div class="comment-box">
                  <div class="comment-head">
                    <h6 class="comment-name">{{ $registrado->name }}</h6>
                  </div>
                  <div class="comment-content">
                    <form class="" action="{{ route('muro.createRespuesta') }}" method="GET">
                      <input class="col-md-12 form-control" type="text" name="respuesta" placeholder="Escribe la respuesta">
                      <input type="hidden" name="comentario_id" value="{{ $comentario->id }}">
                      <button type="submit" class="btn btn-primary btn-muro">Responder</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
			   </li>
        @endforeach
		</div>
	</div>
  <div id='paginacion'>
        @if($comentarios instanceof \Illuminate\Pagination\LengthAwarePaginator)
          <div id="num-paginacion">
            {{ $comentarios->links() }}
          </div>
        @endif
  </div>
@endsection
