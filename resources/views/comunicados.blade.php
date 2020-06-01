@extends('layouts.template')

@section('title')
  Control de Comunicados
@endsection

@section('body')
<div class="container">
      <div class="table-wrapper">
        <!-- Tabla para los enviados -->
          <table class="table table-striped table-hover tabla-comunicados">
              <thead>
                  <tr>
                    <td colspan="4" class="opcion-comunicados"><strong>ENVIADOS</strong></td>
                  </tr>
                  <tr class="titulos-comunicados">
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#nuevoComunicado">
                          <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                      </td>
                      <td><strong>Fecha</strong></td>
                      <td><strong>Asunto</strong></td>
                      <td><strong>Dirigido a</strong></td>
                  </tr>
              </thead>
              <tbody>
                  @php ($count_enviados = 0)

                  @foreach($comunicados as $comunicado)
                    @if($registrado->id == $comunicado->fk_users_id)
                        <tr>
                            <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#detallesComunicado{{$comunicado->id}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </buton>
                            </td>
                            <td>{{ date('d/m/Y', strtotime($comunicado->fecha)) }}</td>
                            <td>{{$comunicado->asunto}}</td>
                            <td>{{$comunicado->userRemitente->name}}</td>
                        </tr>
                        @php ($count_enviados = 1)
                    @endif
                    <!-- modal de visualizacion de comunicados enviados y recividos -->
                    <div class="modal" id="detallesComunicado{{$comunicado->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Detalles del Comunicado</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-row">
                                        <div class="col-md-6 form-group">
                                            <label for="emailRemitente">Dirigido a</label>
                                            <br>
                                            <input type="email" class="form-control" name="emailRemitente" value="{{$comunicado->userRemitente->name}}" disabled>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="emailSustituto">Sustituto</label>
                                            <br>
                                            @if(!is_null($comunicado->fk_user_sustitucion))
                                            <input type="text" class="form-control" name="emailSustituto" value="{{$comunicado->fk_user_sustitucion}}" disabled>
                                            @else
                                            <input type="text" class="form-control" name="emailSustituto" value="ninguno" disabled>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="asunto">Asunto</label>
                                            <textarea class="form-control" rows="2" name="asunto" disabled>{{$comunicado->asunto}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea class="form-control" rows="5" name="descripcion" disabled>{{$comunicado->descripcion}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="respuesta">Respuesta</label>
                                            <textarea class="form-control" rows="5" name="respuesta" disabled>{{$comunicado->respuesta}}</textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($count_enviados==0)
                      <tr>
                        <td colspan="4">No hay registros</td>
                      </tr>
                    @endif
                </tbody>
            </table>

            <!-- Tabla para los recividos -->
            <table class="table table-striped table-hover tabla-comunicados">
                <thead>
                    <tr>
                      <td colspan="4"><strong>RECIBIDOS</strong></td>
                    </tr>
                    <tr class="titulos-comunicados">
                        <td></td>
                        <td><strong>Fecha</strong></td>
                        <td><strong>Asunto</strong></td>
                        <td><strong>Recibido de</strong></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php ($count_recividos = 0)

                    @foreach($comunicados as $comunicado)
                      @if($comunicado->fk_user_remitente == $registrado->id)
                          <tr>
                              <td>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#detallesComunicado{{$comunicado->id}}">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </buton>
                              </td>
                              <td>{{ date('d/m/Y', strtotime($comunicado->fecha)) }}</td>
                              <td>{{$comunicado->asunto}}</td>
                              <td>{{$comunicado->userRemitente->name}}</td>
                              <td>
                                @if($registrado->id == $comunicado->fk_users_id || $comunicado->respuesta != "")
                                  <button class="btn btn-success" data-toggle="modal" data-target="#responderComunicado{{$comunicado->id}}" disabled>
                                      <i class="fa fa-reply" aria-hidden="true"></i>
                                  </buton>
                                @else
                                  <button class="btn btn-success" data-toggle="modal" data-target="#responderComunicado{{$comunicado->id}}">
                                      <i class="fa fa-reply" aria-hidden="true"></i>
                                  </buton>
                                @endif
                              </td>
                          </tr>
                          @php ($count_recividos = 1)
                      @endif
                        <div class="modal" id="responderComunicado{{$comunicado->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Responder Comunicado</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="GET" action="{{ route('comunicados.reply')}}">
                                            {{ csrf_field() }}
                                            <div class="form-row">
                                                <input type="number" name="id" value="{{$comunicado->id}}" hidden>
                                            <div class="col-md-6 form-group">
                                                <label for="emailRemitente">Recibido de</label>
                                                <br>
                                                <input type="email" class="form-control" name="emailRemitente" value="{{$comunicado->userRemitente->name}}" disabled>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="emailSustituto">Sustituto</label>
                                                <br>
                                                @if(!is_null($comunicado->fk_user_sustitucion))
                                                <input type="text" class="form-control" name="emailSustituto" value="{{$comunicado->fk_user_sustitucion}}" disabled>
                                                @else
                                                <input type="text" class="form-control" name="emailSustituto" value="ninguno" disabled>
                                                @endif
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="asunto">Asunto</label>
                                                <textarea class="form-control" rows="2" name="asunto" value="{{$comunicado->asunto}}" disabled>{{$comunicado->asunto}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripción</label>
                                                <textarea class="form-control" rows="5" name="descripcion" value="{{$comunicado->descripcion}}" disabled>{{$comunicado->descripcion}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="respuesta">Responder</label>
                                                <textarea class="form-control" rows="5" name="respuesta" required="required" oninvalid="this.setCustomValidity('Introduce una respuesta valida')" oninput="setCustomValidity('')"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary"></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @endforeach
                  </tbody>
                  @if($count_recividos==0)
                    <tr>
                      <td colspan="5">No hay registros</td>
                    </tr>
                  @endif
              </table>
              <div id='paginacion'>
                    @if($comunicados instanceof \Illuminate\Pagination\LengthAwarePaginator)
                      <div id="num-paginacion">
                        {{ $comunicados->links() }}
                      </div>
                    @endif
              </div>
      </div>
</div>



<div class="modal" id="nuevoComunicado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Comunicado</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('comunicados.create')  }}">
                    {{ csrf_field() }}
                    <div class="form-row">
                      <div class="form-group">
                          <label for="Remitente">Enviar a</label>
                          <select class="form-control" name="Remitente">
                              @foreach($users as $user)
                                  @if($registrado->id != $user->id)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                  @endif
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="Sustituto">Sustituto</label>
                          <select class="form-control" name="Sustituto">
                              <option value="">(Ninguno)</option>
                              @foreach($users as $user)
                                  @if($registrado->id != $user->id)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                  @endif
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="asunto">Asunto</label>
                        <textarea class="form-control" rows="2" name="asunto" required="required" oninvalid="this.setCustomValidity('Introduce un asunto valido')" oninput="setCustomValidity('')"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" rows="5" name="descripcion" required="required" oninvalid="this.setCustomValidity('Introduce una descripción valida')" oninput="setCustomValidity('')"></textarea>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-primary"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
