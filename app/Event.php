<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'id', 'title','start' ,'modulo','usuario_id','laboratorio_id','reserva_id'
    ];
}
