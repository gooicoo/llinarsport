<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    protected $primaryKey = 'id';
    protected $fillable = ['asunto', 'mensaje', 'url', 'fecha', 'fk_users_id'];

    public function user() {
      return $this->belongsTo('App\User','fk_users_id');
    }
    public function respuesta() {
      return $this->hasMany('App\Respuesta');
    }
}
