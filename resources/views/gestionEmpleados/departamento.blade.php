@extends('layouts.template')

@section('title')
  Gestión de Epleados
@endsection

@section('body')

    <div class="container">
      <div class="table-wrapper">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <td><strong>Nombre</strong></td>
                      <td><strong>Apellido</strong></td>
                      <td><strong>Email</strong></td>
                      <td><strong>Intalacion</strong></td>
                      <td><strong>Departamento</strong></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($empleados as $empleado)
                      @if ( ($registrado->fk_departamento_id == $empleado->fk_departamento_id) && ($registrado->fk_instalacion_id==$empleado->fk_instalacion_id) && ($empleado->fk_role_id == 1) )
                          <tr>
                              <td>{{$empleado->name}}</td>
                              <td>{{$empleado->apellido}}</td>
                              <td>{{$empleado->email}}</td>
                              <td>{{$empleado->instalacion->nombre}}</td>
                              <td>{{$empleado->departamento->nombre}}</td>
                          </tr>
                      @endif
                  @endforeach
              </tbody>
          </table>
      </div>


@endsection
