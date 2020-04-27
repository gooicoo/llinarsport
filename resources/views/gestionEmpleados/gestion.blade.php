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
                      <td></td>
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
                      <td>
                        <form action="{{ route('gestionEmpleados.destroy') }}" method="get">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="id" value="{{$empleado->id}}">
                            <button type="submit" value="Delete" class="btn btn-danger"
                                onclick="return confirm('Estas seguro de eliminarlo?')"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>

      <div>
        <button type="button" id="btn-añadir-modal" class="btn btn-primary" data-toggle="modal" data-target="#añadirHorasExtra"> + </button>

        <div class="modal" id="añadirHorasExtra">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Añadir Empleado</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('gestionEmpleados.create')  }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="dni" class="col-md-4 col-form-label text-md-right">DNI</label>
                                <div class="col-md-6">
                                    <input id="dni" class="form-control" type="text" name="dni" required autocomplete="dni" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-6">
                                    <input id="name" class="form-control" type="text" name="name" required autocomplete="name" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellidos</label>
                                <div class="col-md-6">
                                    <input id="apellido" class="form-control" type="text" name="apellido" required autocomplete="apellido" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Correo</label>
                                <div class="col-md-6">
                                    <input id="mail" class="form-control" type="text" name="mail" required autocomplete="mail" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Clave</label>
                                <div class="col-md-6">
                                    <input id="password" class="form-control" type="text" name="password" required autocomplete="password" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">Rol</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="departamento" class="col-md-4 col-form-label text-md-right">Departamento</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="exampleFormControlSelect1" name="departamento">
                                        @foreach($departamentos as $departamento)
                                            <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instalacion" class="col-md-4 col-form-label text-md-right">Instalacion</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="exampleFormControlSelect1" name="instalacion">
                                        @foreach($instalaciones as $instalacion)
                                            <option value="{{$instalacion->id}}">{{$instalacion->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn btn-primary"></input>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
      </div>


    </div>
@endsection
