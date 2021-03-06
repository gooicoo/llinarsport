<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table = 'respuesta';
    protected $primaryKey = 'id';
    protected $fillable = ['mensaje', 'fecha', 'fk_users_id', 'fk_comentario_id',];

    public function user() {
      return $this->belongsTo('App\User','fk_users_id');
    }
    public function comentario() {
      return $this->belongsTo('App\Comentario','fk_comentario_id');
    }
}
