<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'name', 'email', 'dni', 'password',
        'dni', 'name', 'apellido', 'email', 'password', 'remember_token', 'fk_role_id', 'fk_departamento_id', 'fk_instalacion_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];






    // relaciones a otras tablas para recibir el id (roles,departamento,instalacion)
    public function role() {
        return $this->belongsTo('App\Role', 'fk_role_id');
    }
    public function departamento() {
        return $this->belongsTo('App\Departamento', 'fk_departamento_id');
    }
    public function instalacion() {
        return $this->belongsTo('App\Instalacion', 'fk_instalacion_id');
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
    public function comunicadosReimitente() {
        return $this->hasOne('App\Comunicados');
    }
    public function comunicadosSustitucion() {
        return $this->hasOne('App\Comunicados');
    }
    public function comunicadosEmisor() {
        return $this->hasOne('App\Comunicados');
    }

    // relaciones many to many
    public function users_has_sala() {
      return $this->hasMany('App\Users_has_Sala');
    }
    public function actividad_has_users() {
      return $this->hasMany('App\Actividad_has_Users');
    }
}
