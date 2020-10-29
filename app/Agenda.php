<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table="agenda";
    protected $fileable = [
        "usuario_id",
        "fecha",
        "hora_inicio",
        "hora_final",
        "estado"
    ];

}
