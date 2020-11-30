<?php

namespace App\Http\Controllers;
use App\Agenda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Laboratorios;
use App\Reservas;
use Carbon\Carbon;
use App\User;
use DB;
class AgendaController extends Controller
{
    public function index(Request $request){

        $usuarios = User::all();
        $laboratorios = Laboratorios::all();
        $lab = $request->get('id');

        $eventos= DB::table('events')
        ->join('reservas','reservas.id', '=','events.reserva_id')
        ->join('laboratorios','laboratorios.id','=','events.laboratorio_id')
        ->join('users','users.id','=','events.usuario_id')
        ->where('events.laboratorio_id','like',"%$lab%")
        ->select('events.id','events.title','users.name','reservas.Modulos','laboratorios.Nombre','events.start')->get();

        //dd($datos_Eventos);
        return view("agenda.index", compact('eventos','usuarios','laboratorios'));
    }

    public function guardar(Request $request){
        $input = $request -> all();
    }
}
