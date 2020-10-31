<?php

namespace App\Http\Controllers;
use App\Agenda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(){
        return view("agenda.index");
    }

    public function guardar(Request $request){
        $input = $request -> all();
    }
}
