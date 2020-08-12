<?php

namespace App\Http\Controllers;

use App\Reservas;
use App\Http\Controllers\Controller;
use App\Laboratorios;
use App\User;
use DB;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = DB::table('reservas')
        ->join('laboratorios','laboratorios.id', '=','reservas.Laboratorio_id')
        ->join('users','users.id','=','reservas.Usuario_id')
        ->select('reservas.Fecha','reservas.Modulo_inicio','reservas.Modulo_fin','reservas.Motivo','laboratorios.Nombre as Laboratorio','users.name as Usuario')
        ->OrderBy('Laboratorio')->get();

        //dd($reservas->all());

        $usuarios = User::all();

        return view('reservas.index',compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservas = Reservas::all();
        $laboratorios = Laboratorios::all();
        $usuarios = User::all();
        return view('reservas.crear',compact('reservas','laboratorios','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $datosLaboratorios=request()->except('_token');
        Reservas::insert($datosLaboratorios);
        return redirect('/Reservas');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function show(Reservas $reservas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservas $reservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservas $reservas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservas $reservas)
    {
        //
    }
}
