<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    protected $table = 'instalacion';
    protected $primaryKey = 'instalacion_id';
    protected $fillable = ['nombre',];

    public function users() {
        return $this->hasOne('App\Users');
    }
}
