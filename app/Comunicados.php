<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunicados extends Model
{
    protected $table = 'comunicados';
    protected $primaryKey = 'id';
    protected $fillable = ['fk_users_id' ,'fecha', 'asunto', 'descripcion', 'fk_user_remitente', 'respuesta', 'fk_user_sustitucion', ];


    public function userRemitente() {
      return $this->belongsTo('App\User', 'fk_user_remitente');
    }
    public function userSustitucion() {
      return $this->belongsTo('App\User', 'fk_user_sustitucion');
    }
    public function userEmisor() {
      return $this->belongsTo('App\User', 'fk_users_id');
    }
}
