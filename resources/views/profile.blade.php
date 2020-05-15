@extends('layouts.template')

@section('title')
  Perfil
@endsection

@section('body')
<div class="container emp-profile">
              <div class="row">
                  <div class="col-md-4">
                      <div class="profile-img dot">
                          @php
                            $nombre = explode(" ",$registrado->name);
                            $apellido = explode(" ",$registrado->apellido);
                            $inicialNombre = "";
                            $inicialApellido = "";
                            foreach($nombre as $letra){
                                $inicialNombre = $letra[0];
                            }
                            foreach($apellido as $letra){
                                $inicialApellido = $letra[0];
                            }
                            echo "<p class='inicialesNombre'>$inicialNombre$inicialApellido</p>";
                          @endphp
                      </div>
                  </div>
                  <div class="col-md-6">
                      <h5>
                          Perfil
                      </h5>
                      <br>
                      <br>
                      <br>
                      <br>
                      <div class="profile-head">
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos</a>
                              </li>
                              @if($registrado->fk_role_id == 1)
                              <li class="nav-item">
                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Actividades</a>
                              </li>
                              @else
                              <li class="nav-item" hidden>
                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Actividades</a>
                              </li>
                              @endif
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-8">
                      <div class="tab-content profile-tab" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form method="GET" action="{{ route('profile.update') }}">
                              <div class="row">
                                  <div class="col-md-1">
                                      <label>Nombre</label>
                                  </div>
                                  <div class="col-md-3">
                                      <input type="text" class="form-control" value="{{$registrado->name}}" disabled>
                                  </div>
                                  <div class="col-md-1">
                                      <label>Apellido</label>
                                  </div>
                                  <div class="col-md-3">
                                    <input type="text" class="form-control"  value="{{$registrado->apellido}}" disabled>
                                  </div>
                              </div>
                              <hr class="hr_profile">
                              <div class="row">
                                  <div class="col-sm-4 col-md-2 col-lg-3">
                                      <label>NIF / NIE / CIF</label>
                                  </div>
                                  <div class="col-md-3">
                                  <input type="text" class="form-control" name="dni" value="{{$registrado->dni}}" disabled>
                                  </div>
                              </div>
                              <hr class="hr_profile">
                              <div class="row">
                                  <div class="col-md-1">
                                      <label>Correo</label>
                                  </div>
                                  <div class="col-md-3">
                                      <input type="text" class="form-control" name="email" value="{{$registrado->email}}" disabled>
                                  </div>
                                  <div class="col-md-2">
                                      <label>Contraseña</label>
                                  </div>
                                  <div class="col-md-3">
                                    <input type="password" class="form-control" name="password" value="{{$registrado->password}}" disabled>
                                  </div>
                              </div>
                              <div class="btn_perfil">
                                <input type="submit" class="btn btn-success" value="Guardar">
                                <input type="button" id="btn_edit" class="btn btn-primary" value="Editar" onclick="habilitarCampos()">
                              </div>
                            </form>
                          </div>
                          <!-- Parte de actividades -->
                          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form class="row" action="{{ route('profile.añadirActividad')  }}" method="get">
                              <select class="form-control col-md-8" name="actividad">
                                @foreach($actividades as $actividad)
                                  <option value="{{$actividad->id}}">{{$actividad->nombre}}</option>
                                @endforeach
                              </select>
                              <button type="subimt" class="btn">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                              </button>
                            </form>

                            <hr class="hr_profile">

                            <p>Mis actividades</p>
                            @foreach($has_actividades as $has_actividad)
                              @if($registrado->id == $has_actividad->fk_users_id)
                                <form class="row" action="{{ route('profile.borrarActividad')  }}" method="get">
                                  <div class="col-md-12">
                                    <input type="number" name="fk_actividad_id" value="{{ $has_actividad->fk_actividad_id }}" hidden>
                                    <label class="col-md-8">{{$has_actividad->actividad->nombre}}</label>
                                    <button type="subimt" class="btn col-md-1">
                                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                  </div>
                                </form>
                              @endif
                            @endforeach
                          </div>
                      </div>
                  </div>
              </div>
        </div>
@endsection
