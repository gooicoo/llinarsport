<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad_has_Users extends Model
{
    protected $table = 'actividad_has_users';
    protected $fillable = ['fk_actividad_id', 'fk_users_id',];

    public function actividad(){
        return $this->belongsTo('App\Actividad','fk_actividad_id');
    }
    public function users(){
        return $this->belongsTo('App\Users','fk_users_id');
    }


}
