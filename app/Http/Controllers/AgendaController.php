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

        $eventos= DB::table('events')->where('laboratorio_id','like',"%$lab%")
        ->select('id','title','start','laboratorio_id','usuario_id','reserva_id')->get();

        //dd($datos_Eventos);
        return view("agenda.index", compact('eventos','usuarios','laboratorios'));
    }

    public function guardar(Request $request){
        $input = $request -> all();
    }
}
