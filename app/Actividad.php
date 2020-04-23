<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'precio',];

    public function actividad_has_users() {
      return $this->hasMany('App\Actividad_has_Users');
    }
}
