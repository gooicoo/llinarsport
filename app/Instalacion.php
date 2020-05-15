<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    protected $table = 'instalacion';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre',];

    public function user() {
        return $this->hasOne('App\User');
    }
}
