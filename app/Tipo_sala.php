<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_sala extends Model
{
    protected $table = 'tipo_sala';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre',];

    public function sala() {
      return $this->hasMany('App\Sala');
    }
}
