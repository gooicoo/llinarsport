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
                  <h4 class="modal-title">Nuevo Evento</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                      <div class="form-group">
                          <label for="dia">Dia</label>
                          <br>
                          <input type="text" name="dia" id="dia">
                      </div>
                      <div class="form-row">
                        <div class="col-md-3 form-group">
                          <label for="inicio">Hora de Inicio</label>
                          <br>
                          <input type="text" name="inicio" id="inicio">
                        </div>
                        <div class="col-md-3 form-group">
                          <label for="fin">Hora de Fin</label>
                          <br>
                          <input type="text" name="fin" id="fin">
                        </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">Titulo</label>
                          <br>
                          <input type="text" name="titulo" id="titulo">
                      </div>
                      <div class="form-group">
                          <label for="exampleFormControlTextarea1">Descripcion</label>
                          <br>
                          <input type="text" name="descripcion" id="descripcion">
                      </div>
                      <button type="button" id='btnAgregar' name="button">Agergar</button>
            </div>
          </div>
      </div>
  </div>
</div>

@endsection
