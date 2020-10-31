<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Laboratorios;
use App\Reservas;
use Carbon\Carbon;
use App\User;

class AgendaController extends Controller
{
    public function index(){

        $usuarios = User::all();


        $arreglo = Event::all();
        $datos_Eventos=[];
        foreach($arreglo as $eventoPivote){
            //dd($eventoPivote->start);
            $datos_Eventos[]=['title' => [$eventoPivote->title], 'start' =>$eventoPivote->start,'id'=>$eventoPivote->id,
            'end'=>$eventoPivote->end,'modulo'=>[$eventoPivote->modulo],
            'laboratorio_id'=> $eventoPivote->laboratorio_id,
            'usuario_id'=> $eventoPivote->usuario_id,
            'reserva_id'=> $eventoPivote->reserva_id];
        }
        //dd($datos_Eventos);
        return view("agenda.index", compact('datos_Eventos','usuarios'));
    }
}
