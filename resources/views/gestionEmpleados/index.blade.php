@extends('layouts.template')

@section('title')
  Gestión de Epleados
@endsection

@section('body')

    @foreach()
    <div class="container">
      <div class="table-wrapper">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <td><strong>ID</strong></td>
                      <td><strong>Nombre</strong></td>
                      <td><strong>Apellido</strong></td>
                      <td><strong>Email</strong></td>
                      <td><strong>Dni</strong></td>
                      <td><strong>Rol</strong></td>
                      <td><strong>Intalacion</strong></td>
                      <td><strong>Departamento</strong></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($empleados as $empleado)
                  <tr>
                      <td>{{$empleado->id}}</td>
                      <td>{{$empleado->name}}</td>
                      <td>{{$empleado->apellido}}</td>
                      <td>{{$empleado->email}}</td>
                      <td>{{$empleado->dni}}</td>
                      <td>{{$empleado->fk_role_id}}</td>
                      <td>{{$empleado->fk_instalacion_id}}</td>
                      <td>{{$empleado->fk_departamento_id}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
@endsection
