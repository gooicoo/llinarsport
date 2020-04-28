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
                      @if ($registrado->id == $hora->fk_users_id)
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
                      @endif
                  @endforeach
              </tbody>
          </table>
      </div>
      <div>
        <button type="button" id="btn-añadir-modal" class="btn btn-primary" data-toggle="modal" data-target="#añadirHorasExtra">
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
                        <form method="GET" action="{{ route('horasExtras.create')  }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="dia">Dia</label>
                                <br>
                                <input type="date" name="dia" id="dia">
                            </div>
                            <div class="form-row">
                              <div class="col-md-3 form-group">
                                <label for="inicio">Hora de Inicio</label>
                                <br>
                                <input type="time" class="from-control" name="inicio" id="inicio">
                              </div>
                              <div class="col-md-3 form-group">
                                <label for="fin">Hora de Fin</label>
                                <br>
                                <input type="time" class="from-control" name="fin" id="fin">
                              </div>
                              <div class="col-md-4 form-group">
                                <label for="total">Total de Horas</label>
                                <br>
                                <input type="text" class="from-control" name="total" id="total">
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Motivo</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="motivo"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Instalacion</label>
                                <select class="form-control" id="instalacion" name="instalacion">
                                    @foreach($instalaciones as $instalacion)
                                        <option value="{{$instalacion->id}}">{{$instalacion->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Departamento</label>
                                <select class="form-control" id="departamento" name="departamento">
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Actividad</label>
                                <select class="form-control" id="actividad" name="actividad">
                                    @foreach($actividades as $actividad)
                                        <option value="{{$actividad->id}}">{{$actividad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Dia Festivo</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="festivo" id="siFestivo" value="1">
                                    <label class="form-check-label" for="siFestivo">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="festivo" id="noFestivo" value="0" checked>
                                    <label class="form-check-label" for="noFestivo">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Compensar</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="compensar" id="siCompensar" value="1">
                                    <label class="form-check-label" for="siCompensar">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="compensar" id="noCompensar" value="0" checked>
                                    <label class="form-check-label" for="noCompensar">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Hora nocturna</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nocturna" id="siNocturna" value="1">
                                    <label class="form-check-label" for="siNocturna">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="nocturna" id="noNocturna" value="0" checked>
                                    <label class="form-check-label" for="noNocturna">
                                        No
                                    </label>
                                </div>
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
