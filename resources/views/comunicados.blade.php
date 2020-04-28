@extends('layouts.template')

@section('title')
  Control de Comunicados
@endsection

@section('body')
<div class="container">
      <div class="table-wrapper">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <td><strong>Fecha</strong></td>
                      <td><strong>Asunto</strong></td>
                      <td><strong>Descripción</strong></td>
                      <td><strong>Remitente</strong></td>
                      <td><strong>Respuesta</strong></td>
                      <td><strong>Sustituto</strong></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($comunicados as $comunicado)
                    <tr data-toggle="modal" data-target="#responderComunicado">
                        <td>{{$comunicado->fecha}}</td>
                        <td>{{$comunicado->asunto}}</td>
                        <td>{{$comunicado->descripcion}}</td>
                        <td>{{$comunicado->user_remitente}}</td>
                        <td>{{$comunicado->respuesta}}h</td>
                        <td>{{$comunicado->user_sustitucion}}</td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div>
        <button type="button" id="btn-añadir-modal" class="btn btn-primary" data-toggle="modal" data-target="#nuevoComunicado">
        +
        </button>

        <div class="modal" id="nuevoComunicado">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nuevo Comunicado</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" action="{{ route('horasExtras.create')  }}">
                            {{ csrf_field() }}
                            <div class="form-row">
                              <div class="col-md-6 form-group">
                                <label for="emailRemitente">Remitente</label>
                                <br>
                                <input type="email" class="form-control" name="emailRemitente" id="emailRemitente">
                              </div>
                              <div class="col-md-6 form-group">
                                <label for="emailSustituto">Sustituto</label>
                                <br>
                                <input type="email" class="form-control" name="emailSustituto" id="emailSustituto">
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Asunto</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="asunto"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descripción</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="descripcion"></textarea>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="btn btn-primary"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="responderComunicado">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nuevo Comunicado</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" action="{{ route('horasExtras.create')  }}">
                            {{ csrf_field() }}
                            <div class="form-row">
                              <div class="col-md-6 form-group">
                                <label for="emailRemitente">Remitente</label>
                                <br>
                                <input type="email" class="form-control" name="emailRemitente" id="emailRemitente" disabled>
                              </div>
                              <div class="col-md-6 form-group">
                                <label for="emailSustituto">Sustituto</label>
                                <br>
                                <input type="email" class="form-control" name="emailSustituto" id="emailSustituto" disabled>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Asunto</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="asunto" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descripción</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="descripcion" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Responder</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="descripcion"></textarea>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="btn btn-primary"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection