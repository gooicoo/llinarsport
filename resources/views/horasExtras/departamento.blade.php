@extends('layouts.template')

@section('title')
Control de Horas Extras
@endsection

@section('body')
    <div class="container container-extra">
      <div class="row">
          <form class="form-inline">
            <label>Desde: </label>
            <input name="buscarFechaInicio" type="date" class="form-control inputFecha" value="">
            <label>Hasta: </label>
            <input name="buscarFechaFin" type="date" class="form-control inputFecha">
            <label>Empleado: </label>
            <select name="buscarEmpleado" class="form-control inputFecha">
              <option value="">(ningun empleado)</option>
              @foreach($empleados as $empleado)
                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
              @endforeach
            </select>
            <button id="filtroFecha" class="btn btn-primary" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
          </form>
          @if(Session::has('notice'))
              <div class="alert alert-success form-control" id="success-alert">
                 {{ Session::get('notice') }}
              </div>
          @endif
      </div>

      <div class="table-wrapper">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <td><strong>Nombre</strong></td>
                      <td><strong>Apellido</strong></td>
                      <td><strong>Dia</strong></td>
                      <td><strong>H. Inicio</strong></td>
                      <td><strong>H. Fin</strong></td>
                      <td><strong>H. Total</strong></td>
                      <td><strong>Actividad</strong></td>
                      <td class="td_motivo"><strong>Motivo</strong></td>
                      <td><strong>Nocturna</strong></td>
                      <td><strong>Festivo</strong></td>
                      <td><strong>Petición</strong></td>
                      <td><strong>Estado</strong></td>
                      <td></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($horas as $hora)
                    <tr>
                      <form method="GET" action="{{ route('horasExtras.update') }}">
                        <input type="hidden" name="id" value="{{$hora->id}}">
                        <input type="hidden" name="name" value="{{$hora->user->name}}">
                        <td>{{$hora->user->name}}</td>
                        <td>{{$hora->user->apellido}}</td>
                        <td>{{ date('d/m/Y', strtotime($hora->fecha)) }}</td>
                        <td>{{ date('H:i', strtotime($hora->hora_inicio)) }}</td>
                        <td>{{ date('H:i', strtotime($hora->hora_fin)) }}</td>
                        <td>{{$hora->hora_total}}h</td>
                        <td>{{$hora->actividad->nombre}}</td>
                        <td class="td_motivo">{{$hora->motivo}}</td>
                        @if ($hora->hora_nocturna == 0)
                          <td>No</td>
                          @elseif ($hora->hora_nocturna == 1)
                          <td>Si</td>
                        @endif
                        @if ($hora->dia_festivo == 0)
                          <td>No</td>
                          @elseif ($hora->dia_festivo == 1)
                          <td>Si</td>
                        @endif
                        @if ($hora->compensar == 0)
                          <td>Cobrar</td>
                          @elseif ($hora->compensar == 1)
                          <td>Compensar</td>
                        @endif
                        @if ($hora->estado == 0)
                          <td><i class="fa fa-circle estado_empleado" aria-hidden="true"></i></td>
                          @elseif ($hora->estado == 1)
                          <td><i class="fa fa-circle estado_departamento" aria-hidden="true"></i></td>
                          @elseif ($hora->estado == 2)
                          <td><i class="fa fa-circle estado_instalacion" aria-hidden="true"></i></td>
                          @elseif ($hora->estado == 3)
                          <td><i class="fa fa-circle estado_tesorero" aria-hidden="true"></i></td>
                        @endif
                        <input type="hidden" name="estado" value="{{$hora->estado}}">
                        @if ($hora->estado == 0)
                          <td><input class="btn btn-primary" type="submit" value="Verificar"> </td>
                          <!-- <td><button class="btn btn-primary" onclick="VerificarHoraExtra()">Verificar</button> </td> -->
                        @else
                          <td><input class="btn btn-primary" type="submit" value="Verificar" disabled></td>
                        @endif
                      </form>
                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div id='paginacion'>
            @if($horas instanceof \Illuminate\Pagination\LengthAwarePaginator)
              <div id="num-paginacion">
                {{ $horas->links() }}
              </div>
            @endif
      </div>
      <fieldset class="scheduler-border">
          <legend class="scheduler-border">Estado</legend>
          <div class="control-group">
            <label><i class="fa fa-circle estado_empleado" aria-hidden="true"></i> Sin confirmar</label>
            <label><i class="fa fa-circle estado_departamento" aria-hidden="true"></i> Confirmado por el resp. departamento</label>
            <label><i class="fa fa-circle estado_instalacion" aria-hidden="true"></i> Confirmado por el resp. instalación</label>
            <label><i class="fa fa-circle estado_tesorero" aria-hidden="true"></i> Confirmado por la tesorería</label>
          </div>
      </fieldset>
    </div>
@endsection
