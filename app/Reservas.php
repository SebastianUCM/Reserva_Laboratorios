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

    public function scopeLaboratorios($query, $labs) {
    	if ($labs) {
    		return $query->where('labs','like',"%$labs%");
    	}
    }

}
