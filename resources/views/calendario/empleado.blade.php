@extends('layouts.template')

@section('title')
Calendario
@endsection

@section('body')

<div id='calendar'></div>

<div>
  <div class="modal" id="añadirEvento">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Actividad</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <input type="hidden" name="id" id="id">
              <div class="modal-body">
                  <div class="form-group">
                      <label for="dia">Dia</label>
                      <input type="text" class="form-control" name="dia" id="dia">
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 form-group">
                      <label for="inicio">Hora de Inicio</label>
                      <input type="time" class="form-control" name="inicio" id="inicio">
                    </div>
                    <div class="col-md-6 form-group">
                      <label for="fin">Hora de Fin</label>
                      <input type="time" class="form-control" name="fin" id="fin">
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="exampleFormControlTextarea1">Actividad</label>
                      <select class="form-control" id="actividad" name="actividad">
                          @foreach($actividades as $actividad)
                              <option>{{$actividad->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleFormControlTextarea1">Empleado</label>
                      <select class="form-control" id="user" name="user">
                          @foreach($users as $user)
                              @if ($user->fk_role_id == 1)
                                <option>{{$user->name}}</option>
                              @endif
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-12 form-group">
                      <button type="button" id='btnAgregar' class="btn btn-success align-self-start" name="button">Agergar</button>
                      <button type="button" id='btnEditar' class="btn btn-warning align-self-center" name="button">Editar</button>
                      <button type="button" id='btnEliminar' class="btn btn-danger align-self-end" name="button">Eliminar</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>





@endsection
