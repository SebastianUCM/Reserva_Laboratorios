<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    protected $table= 'reservas';

    protected $casts =[
        'Modulos' => 'array'
    ];


    protected $fillable = [
        'id', 'Fecha_inicio','Fecha_fin' ,'Modulos','Motivo','Laboratorio_id','Usuario_id'
    ];

}
