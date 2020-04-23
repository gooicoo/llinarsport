<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamento';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre',];

    public function users() {
        return $this->hasOne('App\Users');
    }
}
