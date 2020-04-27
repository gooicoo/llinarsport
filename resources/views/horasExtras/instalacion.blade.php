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
                      <td><strong>Nombre</strong></td>
                      <td><strong>Apellido</strong></td>
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
                      <td></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($horas as $hora)
                  @if(($registrado->fk_instalacion_id == $hora->fk_instalacion_id) || ($registrado->fk_instalacion_id == 3))
                    <tr>
                    <form method="GET" action="{{ route('horasExtras.update') }}">
                      <input type="hidden" name="id" value="{{$hora->id}}">
                      <td>{{$hora->user->name}}</td>
                      <td>{{$hora->user->apellido}}</td>
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
                      @if ($hora->estado == 1)
                        <td><input class="btn btn-primary" type="submit" value="Verificar"></td>
                      @else
                        <td><input class="btn btn-primary" type="submit" value="Verificar" disabled></td>
                      @endif
                      </form>
                    </tr>
                    @endif
                  @endforeach
              </tbody>
          </table>
      </div>
      
    </div>
@endsection