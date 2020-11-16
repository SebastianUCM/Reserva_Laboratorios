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
          'Usuario_id'=>'required',
          'atomica'=>'required',
        ]);

          $reserva = new Reservas;
          $reserva->Fecha_inicio = $validate['Fecha_inicio'];
          $reserva->Fecha_fin = $validate['Fecha_fin'];
          $reserva->Modulos = $validate['Modulos'];
          $reserva->Motivo = $validate['Motivo'];
          $reserva->Laboratorio_id = $validate['Laboratorio_id'];
          $reserva->Usuario_id = $validate['Usuario_id'];


          

          $fecha_ini=$validate['Fecha_inicio'];
          $fecha_final=$validate['Fecha_fin'];
          $ModulosSeleccionados=$validate['Modulos'];

          //if($fecha_ini< Carbon::now()){
          //  return back()->with('failure', 'ERROR! No es permitido ingresar una fecha anterior a la actual');
          //}
          if($fecha_ini > $fecha_final){
            return back()->with('failure', 'ERROR! La Fecha inicial debe ser menor o igual a la Fecha Final');
          }

            
          if($validate['atomica']=='si'){
            $envios =$this->verificar_disp($fecha_ini,$fecha_final,$ModulosSeleccionados,$validate);
            //dd($envios);

            //Si Hay topones, no se puede reservar
            if($envios){
              return back()->with('failure', 'Ya existe una reserva en donde está solicitando reservar');
            };         
          }
          if($validate['atomica']=='no'){
            $informacion=$this->reservar_disp($fecha_ini,$fecha_final,$ModulosSeleccionados,$validate);
            //dd($informacion);


            //Si no hay modulos disp
            if(!$informacion){
              
              return back()->with('failure', 'ERROR! NO EXISTE DISPONIBILIDAD');
            }
            else{
              $reserva->Modulos = $informacion;

              if($validate)                  //Si llega una peticón .... NO ELIMINAR

                $diaPivote = $fecha_ini;
                $Fecha_final=Carbon::parse($fecha_final)->addDays(1);
                $reserva->save();

                while($diaPivote <= $Fecha_final){

                  foreach($informacion as $ModuloPivote){
                    if((carbon::parse($diaPivote)->dayOfWeek )=='1'){     //Esto equivale al Día Lunes//
                      if($ModuloPivote>=1 && $ModuloPivote<=12){
                        $evento = new Event();
                        $evento->title = $validate['Motivo'];
                        $evento->start = $diaPivote;
                        $evento->modulo = ($ModuloPivote%12);
                        $evento->usuario_id = $validate['Usuario_id'];
                        $evento->laboratorio_id = $validate['Laboratorio_id'];
                        $evento->reserva_id = $reserva->id;
                        //dd($evento->title,$evento->start,$evento->modulo,$evento->usuario_id,$evento->laboratorio_id,$evento->reserva_id);
                        //dd($diaPivote);
                        $evento->save();
                      }
                    }

                    if((carbon::parse($diaPivote)->dayOfWeek )=='2'){     //Esto equivale al Día Martes//
                      if($ModuloPivote>=13 && $ModuloPivote<=24){
                        $evento = new Event();
                        $evento->title = $validate['Motivo'];
                        $evento->start = $diaPivote;
                        $evento->modulo = ($ModuloPivote%12);
                        $evento->usuario_id = $validate['Usuario_id'];
                        $evento->laboratorio_id = $validate['Laboratorio_id'];
                        $evento->reserva_id = $reserva->id;
                        //dd($evento->title,$evento->start,$evento->modulo,$evento->usuario_id,$evento->laboratorio_id,$evento->reserva_id);
                        //dd($diaPivote);
                        $evento->save();
                      }
                    }

                    if((carbon::parse($diaPivote)->dayOfWeek )=='3'){     //Esto equivale al Día Miercoles//
                      if($ModuloPivote>=25 && $ModuloPivote<=36){
                        $evento = new Event();
                        $evento->title = $validate['Motivo'];
                        $evento->start = $diaPivote;
                        $evento->modulo = ($ModuloPivote%12);
                        $evento->usuario_id = $validate['Usuario_id'];
                        $evento->laboratorio_id = $validate['Laboratorio_id'];
                        $evento->reserva_id = $reserva->id;
                        //dd($diaPivote);
                        $evento->save();
                      }
                    }

                    if((carbon::parse($diaPivote)->dayOfWeek )=='4'){     //Esto equivale al Día Jueves//
                      if($ModuloPivote>=37 && $ModuloPivote<=48){
                        $evento = new Event();
                        $evento->title = $validate['Motivo'];
                        $evento->start = $diaPivote;
                        $evento->modulo = ($ModuloPivote%12);
                        $evento->usuario_id = $validate['Usuario_id'];
                        $evento->laboratorio_id = $validate['Laboratorio_id'];
                        $evento->reserva_id = $reserva->id;
                        $evento->save();
                      }
                    }

                    if((carbon::parse($diaPivote)->dayOfWeek )=='5'){     //Esto equivale al Día Viernes//
                      if($ModuloPivote>=49 && $ModuloPivote<=60){
                        $evento = new Event();
                        $evento->title = $validate['Motivo'];
                        $evento->start = $diaPivote;
                        $evento->modulo = ($ModuloPivote%12);
                        $evento->usuario_id = $validate['Usuario_id'];
                        $evento->laboratorio_id = $validate['Laboratorio_id'];
                        $evento->reserva_id = $reserva->id;
                        $evento->save();
                      }
                    }

                    if((carbon::parse($diaPivote)->dayOfWeek )=='6'){     //Esto equivale al Día Sábado//
                      if($ModuloPivote>=61 && $ModuloPivote<=72){
                        $evento = new Event();
                        $evento->title = $validate['Motivo'];
                        $evento->start = $diaPivote;
                        $evento->modulo = ($ModuloPivote%12);
                        $evento->usuario_id = $validate['Usuario_id'];
                        $evento->laboratorio_id = $validate['Laboratorio_id'];
                        $evento->reserva_id = $reserva->id;
                        $evento->save();
                      }
                    }             
                  }
                  $diaPivote=Carbon::parse($diaPivote)->addDays(1);
                }
                //dd($ModuloPivote);
                //return back()->with('success', 'Correcto!. Fue creada correctamente!!');
                return redirect('/Reservas');
                    
                  }
          }
          
          
          if($validate)                  //Si llega una peticón .... NO ELIMINAR

          $diaPivote = $fecha_ini;
          $Fecha_final=Carbon::parse($fecha_final)->addDays(1);
          $reserva->save();

          while($diaPivote <= $Fecha_final){

            foreach($ModulosSeleccionados as $ModuloPivote){
              if((carbon::parse($diaPivote)->dayOfWeek )=='1'){     //Esto equivale al Día Lunes//
                if($ModuloPivote>=1 && $ModuloPivote<=12){
                  $evento = new Event();
                  $evento->title = $validate['Motivo'];
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $validate['Usuario_id'];
                  $evento->laboratorio_id = $validate['Laboratorio_id'];
                  $evento->reserva_id = $reserva->id;
                  //dd($evento->title,$evento->start,$evento->modulo,$evento->usuario_id,$evento->laboratorio_id,$evento->reserva_id);
                  //dd($diaPivote);
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='2'){     //Esto equivale al Día Martes//
                if($ModuloPivote>=13 && $ModuloPivote<=24){
                  $evento = new Event();
                  $evento->title = $validate['Motivo'];
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $validate['Usuario_id'];
                  $evento->laboratorio_id = $validate['Laboratorio_id'];
                  $evento->reserva_id = $reserva->id;
                  //dd($evento->title,$evento->start,$evento->modulo,$evento->usuario_id,$evento->laboratorio_id,$evento->reserva_id);
                  //dd($diaPivote);
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='3'){     //Esto equivale al Día Miercoles//
                if($ModuloPivote>=25 && $ModuloPivote<=36){
                  $evento = new Event();
                  $evento->title = $validate['Motivo'];
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $validate['Usuario_id'];
                  $evento->laboratorio_id = $validate['Laboratorio_id'];
                  $evento->reserva_id = $reserva->id;
                  //dd($diaPivote);
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='4'){     //Esto equivale al Día Jueves//
                if($ModuloPivote>=37 && $ModuloPivote<=48){
                  $evento = new Event();
                  $evento->title = $validate['Motivo'];
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $validate['Usuario_id'];
                  $evento->laboratorio_id = $validate['Laboratorio_id'];
                  $evento->reserva_id = $reserva->id;
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='5'){     //Esto equivale al Día Viernes//
                if($ModuloPivote>=49 && $ModuloPivote<=60){
                  $evento = new Event();
                  $evento->title = $validate['Motivo'];
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $validate['Usuario_id'];
                  $evento->laboratorio_id = $validate['Laboratorio_id'];
                  $evento->reserva_id = $reserva->id;
                  $evento->save();
                }
              }

              if((carbon::parse($diaPivote)->dayOfWeek )=='6'){     //Esto equivale al Día Sábado//
                if($ModuloPivote>=61 && $ModuloPivote<=72){
                  $evento = new Event();
                  $evento->title = $validate['Motivo'];
                  $evento->start = $diaPivote;
                  $evento->modulo = ($ModuloPivote%12);
                  $evento->usuario_id = $validate['Usuario_id'];
                  $evento->laboratorio_id = $validate['Laboratorio_id'];
                  $evento->reserva_id = $reserva->id;
                  $evento->save();
                }
              }             
            }
            $diaPivote=Carbon::parse($diaPivote)->addDays(1);
          }
          //dd($ModuloPivote);
          //return back()->with('success', 'Correcto!. Fue creada correctamente!!');
          return redirect('/Reservas');  

    }
    public function verificar_disp($fecha_ini,$fecha_final,$ModulosSeleccionados,$validate){
      $arreglo=[];
      $diaPivote=$fecha_ini;
      $Fecha_final=Carbon::parse($fecha_final)->addDays(1);
      while($diaPivote <=$Fecha_final){
        foreach($ModulosSeleccionados as $ModuloPivote){

          if((carbon::parse($diaPivote)->dayOfWeek )=='1'){
            if($ModuloPivote>=1 && $ModuloPivote<=12){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if($evento){
                array_push($arreglo,$evento);
              }
              
              //dd($arreglo,$evento);
              
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='2'){
            if($ModuloPivote>=13 && $ModuloPivote<=24){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if($evento){
                array_push($arreglo,$evento);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='3'){
            if($ModuloPivote>=25 && $ModuloPivote<=36){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if($evento){
                array_push($arreglo,$evento);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='4'){
            if($ModuloPivote>=37 && $ModuloPivote<=48){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if($evento){
                array_push($arreglo,$evento);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='5'){
            if($ModuloPivote>=49 && $ModuloPivote<=60){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if($evento){
                array_push($arreglo,$evento);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='6'){
            if($ModuloPivote>=61 && $ModuloPivote<=72){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if($evento){
                array_push($arreglo,$evento);
              }
            }
          }
          
        }
        $diaPivote=Carbon::parse($diaPivote)->addDays(1);
        
      }
      return ($arreglo);

    }

    public function reservar_disp($fecha_ini,$fecha_final,$ModulosSeleccionados,$validate){

      $arreglo=[];
      $diaPivote=$fecha_ini;
      $Fecha_final=Carbon::parse($fecha_final)->addDays(1);
      while($diaPivote <=$Fecha_final){
        foreach($ModulosSeleccionados as $ModuloPivote){
          

          if((carbon::parse($diaPivote)->dayOfWeek )=='1'){
            if($ModuloPivote>=1 && $ModuloPivote<=12){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote%12)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              //print_r($evento->modulo);
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
             
              
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='2'){
            if($ModuloPivote>=13 && $ModuloPivote<=24){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote%12)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
              //print_r($ModuloPivote);
              //dd($evento);
              //var_dump($ModuloPivote);
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='3'){
            if($ModuloPivote>=25 && $ModuloPivote<=36){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote%12)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='4'){
            if($ModuloPivote>=37 && $ModuloPivote<=48){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote%12)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='5'){
            if($ModuloPivote>=49 && $ModuloPivote<=60){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote%12)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='6'){
            if($ModuloPivote>=61 && $ModuloPivote<=72){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote%12)->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
            }
          }
          
        }
        $diaPivote=Carbon::parse($diaPivote)->addDays(1);
       
      }
      return ($arreglo);
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
