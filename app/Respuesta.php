<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table = 'respuesta';
    protected $primaryKey = 'respuesta_id';
    protected $fillable = ['mensaje', 'fecha', 'fk_users_id', 'fk_comentario_id',];

    public function users() {
      return $this->belongsTo('App\Users','fk_users_id');
    }
    public function comentario() {
      return $this->belongsTo('App\Comentario','fk_comentario_id');
    }
}
