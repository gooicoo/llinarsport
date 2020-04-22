<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
      protected $table = 'comentario';
      protected $primaryKey = 'comentario_id';
      protected $fillable = ['asunto', 'mensaje', 'url', 'fecha', 'fk_users_id'];

      public function users() {
        return $this->belongsTo('App\Users','fk_users_id');
      }
      public function respuesta() {
        return $this->hasMany('App\Respuesta');
      }
}
