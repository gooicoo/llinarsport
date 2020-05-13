@extends('layouts.template')

@section('title')
Gestion de Actividades
@endsection

@section('body')
    <div class="container container_actividad">
        <div class="table-wrapper">
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <td>
                          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#añadirActividad">
                              <i class="fa fa-plus" aria-hidden="true"></i>
                          </button>
                      </td>
                      <td><strong>Actividad</strong></td>
                      <td><strong>Precio</strong></td>
                      <td></td>
                  </tr>
              </thead>
              <tbody>
                  @foreach($actividades as $actividad)
                    <tr>
                        <input type="hidden" name="id" value="{{$actividad->id}}">
                        <td>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#modificarActividades{{$actividad->id}}">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                          </button>
                        </td>
                        <td>{{$actividad->nombre}}</td>
                        <td>{{$actividad->precio}}</td>
                        <td>
                          <form action="{{ route('gestionActividades.destroy') }}" method="get">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <input type="hidden" name="id" value="{{$actividad->id}}">
                              <button type="submit" value="Delete" class="btn btn-danger"
                                  onclick="return confirm('Estas seguro de eliminarlo?')"><i class="fa fa-trash"></i></button>
                          </form>
                        </td>
                    </tr>

                    <div class="modal" id="modificarActividades{{$actividad->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modificar Actividad</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form method="GET" action="{{ route('gestionActividades.edit')  }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$actividad->id}}">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" value="{{$actividad->nombre}}" required="required" oninvalid="this.setCustomValidity('Introduce un nombre valida')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="number" name="precio" id="precio" value="{{$actividad->precio}}" required="required" oninvalid="this.setCustomValidity('Introduce un precio valida')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="modal-footer">
                                          <input type="submit" class="btn btn-primary"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                  @endforeach
              </tbody>
          </table>
      </div>

      <!-- modal para crear horas -->
      <div>
        <div class="modal" id="añadirActividad">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Añadir Actividad</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" action="{{ route('gestionActividades.create')  }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="dia">Nombre</label>
                                <input type="text" name="nombre" id="nombre" required="required" oninvalid="this.setCustomValidity('Introduce un nombre valida')" oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="dia">Precio</label>
                                <input type="number" step="0.01" name="precio" id="precio" required="required" oninvalid="this.setCustomValidity('Introduce un precio valida')" oninput="setCustomValidity('')">
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
