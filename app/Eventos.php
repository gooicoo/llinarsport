<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id';
    protected $fillable = ['title','user','start','end'];

}
