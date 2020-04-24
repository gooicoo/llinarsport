@extends('layouts.template')

@section('title')
Control de Horas Extras
@endsection

@section('body')
    
    <div class="container">
      <div class="table-wrapper">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <td><strong>Departamento</strong></td>
                      <td><strong>Dia</strong></td>
                      <td><strong>Hora Inicio</strong></td>
                      <td><strong>Hora Fin</strong></td>
                      <td><strong>Total de Horas</strong></td>
                      <td><strong>Hora Nocturna</strong></td>
                      <td><strong>Motivo</strong></td>
                      <td><strong>Dia Festivo</strong></td>
                      <td><strong>Actividad</strong></td>
                      <td><strong>Precio</strong></td>
                      <td><strong>Compensar / Cobrar</strong></td>
                      <td><strong>Estado</strong></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($horas as $hora)
                  <tr>
                      <td>{{$hora->departamento->nombre}}</td>
                      <td>{{$hora->fecha}}</td>
                      <td>{{$hora->hora_inicio}}</td>
                      <td>{{$hora->hora_fin}}</td>
                      <td>{{$hora->hora_total}}h</td>
                      <td>{{$hora->hora_nocturna}}</td>
                      <td>{{$hora->motivo}}</td>
                      @if ($hora->dia_festivo == 0)
                        <td>No</td>
                        @elseif ($hora->dia_festivo == 1)
                        <td>Si</td>
                      @endif
                      <td>{{$hora->actividad->nombre}}</td>
                      @if ($hora->dia_festivo == 0)
                      <td>{{$hora->actividad->precio*$hora->hora_total}}</td>
                        @elseif ($hora->dia_festivo == 1)
                        <td>{{($hora->actividad->precio+10.50)*$hora->hora_total}}</td>
                      @endif
                      @if ($hora->compensar == 0)
                        <td>Cobrar</td>
                        @elseif ($hora->compensar == 1)
                        <td>Compensar</td>
                      @endif
                      @if ($hora->estado == 0)
                        <td>Sin Confirmar</td>
                        @elseif ($hora->estado == 1)
                        <td>Res. Departamento</td>
                        @elseif ($hora->estado == 2)
                        <td>Res. Instalacion</td>
                        @elseif ($hora->estado == 3)
                        <td>Tesorero</td>
                      @endif
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#añadirHorasExtra">
        +
        </button>

        <div class="modal" id="añadirHorasExtra">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Añadir Horas Extra</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="form-group">
                            <label for="dia">Dia</label>
                            <br>
                            <input type="date" name="dia" id="dia">
                        </div>
                        <div class="form-group">
                            <label for="inicio">Hora de Inicio</label>
                            <br>
                            <input type="time" name="inicio" id="inicio">
                        </div>
                        <div class="form-group">
                            <label for="fin">Hora de Fin</label>
                            <br>
                            <input type="time" name="fin" id="fin">
                        </div>
                        <div class="form-group">
                            <label for="total">Total de Horas</label>
                            <br>
                            <input type="text" name="total" id="total">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Motivo</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Dia Festivo</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="festivo" id="siFestivo" value="siFestivo">
                                <label class="form-check-label" for="siFestivo">
                                    Si
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="festivo" id="noFestivo" value="noFestivo" checked>
                                <label class="form-check-label" for="noFestivo">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Actividad</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                @foreach($actividades as $actividad)
                                    <option>{{$actividad->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Compensar</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="compensar" id="siCompensar" value="siCompensar">
                                <label class="form-check-label" for="siCompensar">
                                    Si
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="compensar" id="noCompensar" value="noCompensar" checked>
                                <label class="form-check-label" for="noCompensar">
                                    No
                                </label>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div> 
      </div>
    </div>
@endsection