<?php

namespace App\Http\Controllers;

use App\Reservas;
use App\Http\Controllers\Controller;
use App\Laboratorios;
use App\User;
use Carbon\Carbon;
use App\Event;
Use Session;

//use DB;
use Illuminate\Http\Response;
//use App\Http\Controllers\Response;
use App\Http\Resources\ReservaResource as ReservaResource;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
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
        $reservas = DB::table('reservas')
        ->join('laboratorios','laboratorios.id', '=','reservas.Laboratorio_id')
        ->join('users','users.id','=','reservas.Usuario_id')
        ->select('reservas.id','reservas.Fecha_inicio','reservas.Fecha_fin','reservas.Modulos','reservas.Motivo','laboratorios.Nombre as Laboratorio','users.name as Usuario')
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

        $validate = $request->validate([
          'Fecha_inicio' => 'required',
          'Fecha_fin' => 'required',
          'Motivo'=>'required',
          'Laboratorio_id'=>'required',
          'Modulos'=>'required',
          'Laboratorio_id'=>'required',
          'atomica'=>'required',
        ]);

          $reserva = new Reservas;
          $reserva->Fecha_inicio = $request->Fecha_inicio;
          $reserva->Fecha_fin = $request->Fecha_fin;
          $reserva->Modulos = $request->Modulos;
          $reserva->Motivo = $request->Motivo;
          $reserva->Laboratorio_id = $request->Laboratorio_id;
          $reserva->Usuario_id = $request->Usuario_id;
          
             


          if($validate['atomica']=='si'){
            $envios =$this->verificar_disp($reserva->Fecha_inicio,$reserva->Fecha_fin,$reserva->Modulos,$validate);
            //dd($envios);
            if($envios){
              $error="Ya existe una reserva en donde está solicitando reservar";
              //return redirect('/Reservas',compact('error'))->with('danger','ERROR DE REGISTRO');
            };         
          }
          $reserva->save();
          
          


          if($request)                  //Si llega una peticón .... NO ELIMINAR

          $diaPivote = $request->Fecha_inicio;
          $Fecha_final=Carbon::parse($request->Fecha_fin)->addDays(1);

          while($diaPivote <= $Fecha_final){

            foreach($request->Modulos as $ModuloPivote){
              if((carbon::parse($diaPivote)->dayOfWeek )=='1'){     //Esto equivale al Día Lunes//
                if($ModuloPivote>=1 && $ModuloPivote<=12){
                  $evento = new Event();
                  $evento->title = $request->Motivo;
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $request->Usuario_id;
                  $evento->laboratorio_id = $request->Laboratorio_id;
                  $evento->reserva_id = $reserva->id;
                  //dd($evento->title,$evento->start,$evento->modulo,$evento->usuario_id,$evento->laboratorio_id,$evento->reserva_id);
                  //dd($diaPivote);
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='2'){     //Esto equivale al Día Martes//
                if($ModuloPivote>=13 && $ModuloPivote<=24){
                  $evento = new Event();
                  $evento->title = $request->Motivo;
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $request->Usuario_id;
                  $evento->laboratorio_id = $request->Laboratorio_id;
                  $evento->reserva_id = $reserva->id;
                  //dd($evento->title,$evento->start,$evento->modulo,$evento->usuario_id,$evento->laboratorio_id,$evento->reserva_id);
                  //dd($diaPivote);
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='3'){     //Esto equivale al Día Miercoles//
                if($ModuloPivote>=25 && $ModuloPivote<=36){
                  $evento = new Event();
                  $evento->title = $request->Motivo;
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $request->Usuario_id;
                  $evento->laboratorio_id = $request->Laboratorio_id;
                  $evento->reserva_id = $reserva->id;
                  //dd($diaPivote);
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='4'){     //Esto equivale al Día Jueves//
                if($ModuloPivote>=37 && $ModuloPivote<=48){
                  $evento = new Event();
                  $evento->title = $request->Motivo;
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $request->Usuario_id;
                  $evento->laboratorio_id = $request->Laboratorio_id;
                  $evento->reserva_id = $reserva->id;
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='5'){     //Esto equivale al Día Viernes//
                if($ModuloPivote>=49 && $ModuloPivote<=60){
                  $evento = new Event();
                  $evento->title = $request->Motivo;
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $request->Usuario_id;
                  $evento->laboratorio_id = $request->Laboratorio_id;
                  $evento->reserva_id = $reserva->id;
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='6'){     //Esto equivale al Día Sábado//
                if($ModuloPivote>=61 && $ModuloPivote<=72){
                  $evento = new Event();
                  $evento->title = $request->Motivo;
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $request->Usuario_id;
                  $evento->laboratorio_id = $request->Laboratorio_id;
                  $evento->reserva_id = $reserva->id;
                  $evento->save();
                }
              }             
            }
            $diaPivote=Carbon::parse($diaPivote)->addDays(1);
          }
          //dd($ModuloPivote);
          return redirect('/Reservas');  

    }
    public function verificar_disp($Fecha_inicio,$Fecha_fin,$Modulos,$validate){
      $arreglo=[];
      $diaPivote=$Fecha_inicio;
      while($diaPivote <=$Fecha_fin){
        foreach($Modulos as $ModuloPivote){

          if((carbon::parse($diaPivote)->dayOfWeek )=='1'){
            if($ModuloPivote>=1 && $ModuloPivote<=12){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              array_push($arreglo,$evento);
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='2'){
            if($ModuloPivote>=13 && $ModuloPivote<=24){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              array_push($arreglo,$evento);
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='3'){
            if($ModuloPivote>=25 && $ModuloPivote<=36){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              array_push($arreglo,$evento);
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='4'){
            if($ModuloPivote>=37 && $ModuloPivote<=48){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              array_push($arreglo,$evento);
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='5'){
            if($ModuloPivote>=49 && $ModuloPivote<=60){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              array_push($arreglo,$evento);
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='6'){
            if($ModuloPivote>=61 && $ModuloPivote<=72){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              array_push($arreglo,$evento);
            }
          }
          $diaPivote=Carbon::parse($diaPivote)->addDays(1);
        }
        return ($arreglo);
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
