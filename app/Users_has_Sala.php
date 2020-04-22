<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_has_Sala extends Model
{
    protected $table = 'users_has_sala';
    protected $fillable = ['fk_users_id', 'fk_sala_id'];

    public function sala(){
        return $this->belongsTo('App\Sala','fk_sala_id');
    }
    public function users(){
        return $this->belongsTo('App\Users','fk_users_id');
    }
}
