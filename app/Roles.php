<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'roles_id';
    protected $fillable = ['nombre',];

    public function users() {
        return $this->hasOne('App\Users');
    }
}
