<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_has_Comunicados extends Model
{
    protected $table = 'users_has_comunicados';
    protected $fillable = ['fk_users_id', 'fk_comunicado_id'];

    public function actividad(){
        return $this->belongsTo('App\Comunicados','fk_comunicado_id');
    }
    public function users(){
        return $this->belongsTo('App\Users','fk_users_id');
    }
}
