<?php

namespace App\Http\Controllers;

use App\Laboratorios;
use App\Carrera;
use Illuminate\Http\Request;

class LaboratoriosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }




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
        $carreras = Carrera::all();
        return view('Laboratorios.editar', compact('laboratorio','carreras'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laboratorios  $laboratorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $nuevoDato=Laboratorios::find($id);
        $nuevoDato->Nombre = $request->Nombre;
        $nuevoDato->Codigo = $request->Codigo;
        $nuevoDato->Capacidad = $request->Capacidad;
        $nuevoDato->save();
        
        return redirect("Laboratorios");
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
