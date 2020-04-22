<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'sala';
    protected $primaryKey = 'sala_id';
    protected $fillable = ['fecha','fk_tipo_sala_id'];

    public function tipo_sala() {
      return $this->belongsTo('App\Tipo_sala');
    }
    public function mensaje() {
      return $this->hasMany('App\Mensaje');
    }
    public function users_has_sala() {
      return $this->hasMany('App\Users_has_Sala');
    }
}
