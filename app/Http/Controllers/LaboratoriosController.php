<?php

namespace App\Http\Controllers;

use App\Laboratorios;
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
        // Retorno los datos a la vista inicio de laboratorio usando paginacion
        $datos['laboratorios']=Laboratorios::paginate(10);
        // Retorna la vista de inicio de laboratorios
        return view('Laboratorios.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Laboratorios.crear');
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
    public function update(Request $request, Laboratorios $id)
    {
        //
        $datosLaboratorios=request()->except(['_token','_method']);
        Laboratorios::where('id','=',$id)->update($datosLaboratorios);
        $laboratorio= Laboratorios::findOrFail($id);
        return view('Laboratorios.editar', compact('laboratorio'));
       
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
