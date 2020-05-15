<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamento';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre',];

    public function user() {
        return $this->hasOne('App\User');
    }

    public function horas_extra() {
        return $this->hasOne('App\Horas_extra');
    }
}
