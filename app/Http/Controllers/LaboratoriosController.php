<?php

namespace App\Http\Controllers;

use App\Laboratorios;
use App\Carrera;
use Illuminate\Http\Request;

class LaboratoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratorios = Laboratorios::all();
        $carreras = Carrera::all();
        return view('laboratorios.index',compact('laboratorios','carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $laboratorios = Laboratorios::all();
        $carreras = Carrera::all();
        return view('laboratorios.crear',compact('laboratorios','carreras'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datosLaboratorios=request()->except('_token');
        Laboratorios::insert($datosLaboratorios);

        return redirect('/Laboratorios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Laboratorios  $laboratorios
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratorios $laboratorios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laboratorios  $laboratorios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laboratorio= Laboratorios::findOrFail($id);
        return view('Laboratorios.editar', compact('laboratorio'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laboratorios  $laboratorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratorios $laboratorios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laboratorios  $laboratorios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $destroy = Laboratorios::destroy($id);
        
        if ($destroy){
            $id=[
                'status'=>'1',
                'msg'=>'success'
            ];
        
        }else{
        
            $id=[
                'status'=>'0',
                'msg'=>'fail'
            ];
        
        }
        return redirect('/Laboratorios');
    }
}
