<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horas_extra extends Model
{
    protected $table = 'horas_extra';
    protected $primaryKey = 'id';
    protected $fillable = ['fecha', 'hora_inicio', 'hora_fin', 'hora_fin', 'motivo', 'dia_festivo', 'compensar', 'fk_users_id', 'fk_actividad_id'];

    public function users() {
        return $this->belongsTo('App\Users');
    }
    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
