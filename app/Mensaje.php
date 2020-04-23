<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensaje';
    protected $primaryKey = 'id';
    protected $fillable = ['mensaje','fecha','url','sala_id','fk_users_id'];

    public function sala() {
        return $this->belongsTo('App\Sala');
    }
    public function mensaje() {
        return $this->belongsTo('App\Users');
    }
}
