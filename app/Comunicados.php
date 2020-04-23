<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunicados extends Model
{
    protected $table = 'comunicados';
    protected $primaryKey = 'id';
    protected $fillable = ['fecha', 'asunto', 'descripcion', 'user_remitente', 'respuesta', 'user_sustitucion', ];

    public function users_has_comunicados() {
      return $this->hasMany('App\Users_has_Comunicados');
    }
}
