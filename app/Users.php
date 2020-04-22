<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'users_id';
    protected $fillable = ['dni', 'nombre', 'apellido', 'password', 'fk_role_id', 'fk_departamento_id', 'fk_instalacion_id'];

    // relaciones a otras tablas para recibir el id (roles,departamento,instalacion)
    public function roles() {
        return $this->belongsTo('App\Roles');
    }
    public function departamento() {
        return $this->belongsTo('App\Departamento');
    }
    public function instalacion() {
        return $this->belongsTo('App\Instalacion');
    }

    // relaciones a otras tablas para enviar el users_id
    public function horas_extra() {
        return $this->hasMany('App\Horas_extra');
    }
    public function mensaje() {
        return $this->hasMany('App\Mensaje');
    }
    public function comentario() {
        return $this->hasMany('App\Comentario');
    }

    // relaciones many to many
    public function users_has_comunicados() {
      return $this->hasMany('App\Users_has_Comunicados');
    }
    public function users_has_sala() {
      return $this->hasMany('App\Users_has_Sala');
    }
    public function actividad_has_users() {
      return $this->hasMany('App\Actividad_has_Users');
    }



}
