<?php

namespace App\Http\Controllers;

use App\Reservas;
use App\Http\Controllers\Controller;
use App\Laboratorios;
use App\User;
//use DB;
use Illuminate\Http\Response;
//use App\Http\Controllers\Response;
use App\Http\Resources\ReservaResource as ReservaResource;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

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
        ->select('reservas.id','reservas.Fecha','reservas.Modulo_inicio','reservas.Modulo_fin','reservas.Motivo','laboratorios.Nombre as Laboratorio','users.name as Usuario')
        ->OrderBy('Laboratorio')
        ->get();

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

        //$datosLaboratorios=request()->except('_token');
        //Reservas::insert($datosLaboratorios);
        //return redirect('/Reservas');

        $reservado = $this->horarioReservado($request);
        if($reservado){
            //return response(['status'=>0,'message'=>'Reserva ocupada']);//->setStatusCode(Response::HTTP_ACCEPTED);
            return redirect('/Reservas');
        }else{
            $reserva = new Reservas;
            $reserva->Fecha = $request->Fecha;
            $reserva->Modulo_inicio = $request->Modulo_inicio;
            $reserva->Modulo_fin = $request->Modulo_fin;
            $reserva->Motivo = $request->Motivo;
            $reserva->Laboratorio_id = $request->Laboratorio_id;
            $reserva->Usuario_id = $request->Usuario_id;
            $reserva->save();
            if($reserva){
                //return (new ReservaResource($reserva))->response->response()->setStatusCode(Response::HTTP_CREATED); 
                return redirect('/Reservas');
            }
        }
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
    public function edit($id)
    {
        $reserva= Reservas::findOrFail($id);
        return view('Reservas.editar', compact('reserva'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $nuevoDato=Reservas::find($id);
        $nuevoDato->Fecha = $request->Fecha;
        $nuevoDato->Modulo_inicio = $request->Modulo_inicio;
        $nuevoDato->Modulo_fin = $request->Modulo_fin;
        $nuevoDato->Motivo = $request->Motivo;
        $nuevoDato->Laboratorio_id= $request->Laboratorio_id;
        $nuevoDato->Usuario_id = $request->Usuario_id;
        
        $nuevoDato->save();
        
        return redirect("Reservas");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Reservas::destroy($id);
        
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
        return redirect('/Reservas');
    }

    private function horarioReservado($request){
        $reservado = false;
        $reserva_inicial = Reservas::where('Fecha',$request->fecha)
        ->where('Laboratorio_id',$request->Laboratorio_id)
        ->where('Modulo_inicio','<=',$request->Modulo_inicio)
        ->where('Modulo_fin','>=',$request->Modulo_fin)
        ->count();
        if($reserva_inicial > 0){
            $reservado = true;
        }

        $reserva_final = Reservas::where('Fecha',$request->Fecha)
        ->where('Laboratorio_id',$request->Laboratorio_id)
        ->where('Modulo_inicio','<=',$request->Modulo_fin)
        ->where('Modulo_fin','>=',$request->Modulo_fin)
        ->count();
        if($reserva_final > 0){
            $reservado = true;
        }

        $reserva_inicial_final = Reservas::where('Fecha',$request->Fecha)
        ->where('Laboratorio_id',$request->Laboratorio_id)
        ->where('Modulo_inicio','>=',$request->Modulo_inicio)
        ->where('Modulo_fin','<=',$request->Modulo_fin)
        ->count();
        if($reserva_inicial_final > 0){
            $reservado = true;
        }

        return $reservado;

    }
}
