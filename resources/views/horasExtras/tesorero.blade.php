@extends('layouts.template')

@section('title')
Control de Horas Extras
@endsection

@section('body')

    <div class="container">
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
                @if ( $empleado->id != $registrado->id )
                  <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                @endif
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
                      <td><strong>H. Total</strong></td>
                      <td><strong>Actividad</strong></td>
                      <td><strong>Hora Nocturna</strong></td>
                      <td><strong>Dia Festivo</strong></td>
                      <td><strong>Precio</strong></td>
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
                    <td>{{$hora->user->name}}</td>
                      <td>{{$hora->user->apellido}}</td>
                      <td>{{$hora->fecha}}</td>
                      <td>{{$hora->hora_total}}h</td>
                      <td>{{$hora->actividad->nombre}}</td>
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
                        <td><i class="fa fa-circle estado_empleado" aria-hidden="true"></i></td>
                        @elseif ($hora->estado == 1)
                        <td><i class="fa fa-circle estado_departamento" aria-hidden="true"></i></td>
                        @elseif ($hora->estado == 2)
                        <td><i class="fa fa-circle estado_instalacion" aria-hidden="true"></i></td>
                        @elseif ($hora->estado == 3)
                        <td><i class="fa fa-circle estado_tesorero" aria-hidden="true"></i></td>
                      @endif
                      @if ($hora->estado == 2)
                        <td><input class="btn btn-primary" type="submit" value="Verificar"></td>
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
      <div id='informacion_boton' class="informacion_estados">
          <button type="button" class="estado_button btn" name="estado_button" onmouseover="openEstados(event)">ESTADO</button>
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
