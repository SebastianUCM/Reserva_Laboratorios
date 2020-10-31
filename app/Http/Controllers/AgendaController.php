<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Reservas;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index(){

        $arreglo = Event::all();
        $datos_Eventos=[];
        foreach($arreglo as $eventoPivote){
            //dd($eventoPivote->start);
            $datos_Eventos[]=['title' => [$eventoPivote->title], 'start' =>$eventoPivote->start];
        }
        //dd($datos_Eventos);
        return view("agenda.index", compact('datos_Eventos'));
    }
}
