<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horas_extra extends Model
{
    protected $table = 'horas_extra';
    protected $primaryKey = 'id';
    protected $fillable = ['fecha', 'hora_inicio', 'hora_fin', 'hora_fin', 'hora_nocturna', 'motivo', 'dia_festivo', 'compensar', 'fk_users_id', 'fk_departamento_id','fk_actividad_id', 'estado'];

    public function user() {
        return $this->belongsTo('App\User', 'fk_users_id');
    }
    public function actividad() {
        return $this->belongsTo('App\Actividad', 'fk_actividad_id');
    }
    public function departamento() {
        return $this->belongsTo('App\Departamento', 'fk_departamento_id');
    }
    
}
