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
                      <td>{{$empleado->role->nombre}}</td>
                      <td>{{$empleado->instalacion->nombre}}</td>
                      <td>{{$empleado->departamento->nombre}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
@endsection
