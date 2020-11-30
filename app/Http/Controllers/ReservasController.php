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
    public function index(Request $request)
    {
      $laboratorios=Laboratorios::all();
      $reservas=Reservas::all();

      $lab = $request->get('Laboratorio_id');
      //dd($lab);

      $resevs= DB::table('reservas')->where('Laboratorio_id','like',"%$lab%")
      ->join('laboratorios','laboratorios.id', '=','reservas.Laboratorio_id')->
      join('users','users.id','=','reservas.Usuario_id')
      ->select('reservas.id','reservas.Fecha_inicio','reservas.Fecha_fin','reservas.Modulos','reservas.Motivo','laboratorios.Nombre as Laboratorio','users.name as Usuario')
      ->paginate(5);

        return view('reservas.index',compact('laboratorios','resevs'));
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
                        $evento->modulo = ($ModuloPivote );
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
                        $evento->modulo = ($ModuloPivote );
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
                        $evento->modulo = ($ModuloPivote );
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
                        $evento->modulo = ($ModuloPivote );
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
                        $evento->modulo = ($ModuloPivote );
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
                        $evento->modulo = ($ModuloPivote );
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
                  $evento->modulo = ($ModuloPivote );
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
                  $evento->modulo = ($ModuloPivote );
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
                  $evento->modulo = ($ModuloPivote );
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
                  $evento->modulo = ($ModuloPivote );
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
                  $evento->modulo = ($ModuloPivote );
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
                  $evento->modulo = ($ModuloPivote );
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
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote )->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              //print_r($evento->modulo);
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
             
              
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='2'){
            if($ModuloPivote>=13 && $ModuloPivote<=24){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote )->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              
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
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote )->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='4'){
            if($ModuloPivote>=37 && $ModuloPivote<=48){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote )->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='5'){
            if($ModuloPivote>=49 && $ModuloPivote<=60){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote )->where('laboratorio_id',$validate['Laboratorio_id'])->first();
              if(!$evento){
                array_push($arreglo,$ModuloPivote);
              }
            }
          }
          if((carbon::parse($diaPivote)->dayOfWeek )=='6'){
            if($ModuloPivote>=61 && $ModuloPivote<=72){
              $evento = Event::where('start',$diaPivote)->where('modulo',$ModuloPivote )->where('laboratorio_id',$validate['Laboratorio_id'])->first();
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




    public function guardado($Fecha_inicio,$ModulosSeleccionados,$Fecha_final,$validate,$reserva){

      $diaPivote= $Fecha_inicio;

      $informacion=$this->reservar_disp($Fecha_inicio,$Fecha_final,$ModulosSeleccionados,$validate);

      while($diaPivote <= $Fecha_final){

        foreach($informacion as $ModuloPivote){
          if((carbon::parse($diaPivote)->dayOfWeek )=='1'){     //Esto equivale al Día Lunes//
            if($ModuloPivote>=1 && $ModuloPivote<=12){
              $evento = new Event();
              $evento->title = $validate['Motivo'];
              $evento->start = $diaPivote;
              $evento->modulo = ($ModuloPivote );
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
              $evento->modulo = ($ModuloPivote );
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
              $evento->modulo = ($ModuloPivote );
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
              $evento->modulo = ($ModuloPivote );
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
              $evento->modulo = ($ModuloPivote );
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
              $evento->modulo = ($ModuloPivote );
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
  
    public function ActualizarModulo(Reservas $reserva){
      return view('Reservas.editar_modulo', compact('reserva'));
    }

    public function ModificarModulos(Reservas $reserva, Request $request){

      $validate = $request->validate([
        'Fecha_inicio' => 'required',
        'Fecha_fin' => 'required',
        'Motivo'=>'required',
        'Laboratorio_id'=>'required',
        'Modulos'=>'required',
        'Laboratorio_id'=>'required',
        'Usuario_id'=>'required',


      ]);
        $fecha_ini=$validate['Fecha_inicio'];
        $fecha_final=$validate['Fecha_fin'];
        $ModulosSeleccionados=$validate['Modulos'];

        $ModulosNuevos=[];

        foreach($request->Modulos as $Modulo){         //Voy recorriendo Lo recibido de la vista como un Módulo
          if(in_array($Modulo,$reserva->Modulos)){     //Verifico si está dentro del arreglo

          }
          else{                                        //Si no está dentro, pasa a una nueva variable vacia 
            $ModulosNuevos[]=$Modulo;

          }
        }
        //dd($ModulosNuevo);
        $informacion =$this->verificar_disp($fecha_ini,$fecha_final,$ModulosNuevos,$validate);

        if($informacion){
          return back()->with('failure', 'ERROR!. Ese módulo está ocupado');
        }
        $this->guardado($fecha_ini,$ModulosSeleccionados,$fecha_final,$validate,$reserva);

        foreach($reserva->Modulos as $ModuloOriginal){
          if(in_array($ModuloOriginal,$request->Modulos)){
          }
          else{
            $eventos = Event::where('reserva_id',$reserva->id)
                ->whereDate('start','>=',$fecha_ini)
                ->whereDate('start','<=',$fecha_final)
                ->where('modulo',$ModuloOriginal)
                ->get();
                foreach($eventos as $evento){
                  $evento->destroy($evento->id);
                }            
          }
        }
        
        
        $reserva->Modulos = $ModulosSeleccionados;


        $reserva->save();
        return back()->with('success', 'Correcto!. Se ha modificado Correctamente!');

    }

    public function desactivarFecha(Reservas $reserva){
      return view('Reservas.desactivarfechas', compact('reserva'));

    }

    public function desocuparFecha(Request $request, Reservas $reserva){

      $validate = $request->validate([
          'Fecha_inicio' => 'required',
          'Fecha_fin' => 'required',
          'Modulos'=>'required',
          'Motivo'=>'required',
          'Laboratorio_id'=>'required',
          'Usuario_id'=>'required',
          'inicio_inactivacion' => ['required','after:'.$request['Fecha_inicio'], 'before:'.$request['Fecha_fin'],'before:'.$request['fin_inactivacion']],
          'fin_inactivacion'=>['required','after:'.$request['Fecha_inicio'],'before:'.$request['Fecha_fin'],'after:'.$request['inicio_inactivacion']],
      ]);

      $eventos= Event::where('reserva_id','=',$reserva->id)          //Busco En la tabla de Eventos si la Id de la tabla reserva está en la tabla de Eventos
      ->whereDate('start','>=',$validate['inicio_inactivacion'])
      ->whereDate('start','<=',$validate['fin_inactivacion'])->get();

      $eventoArreglos=$eventos->toArray();
      foreach($eventoArreglos as $EventoPivote){
        $evento_id= $EventoPivote['id'];
        Event::destroy($evento_id); 
      }
      return back()->with('success', 'Correcto!. Se ha liberado correctamente la fecha solicitada!');
    }

    public function VistaModFechas(Reservas $reserva){
      return view('Reservas.ModificarFechas', compact('reserva'));

    }
    public function ModificarFecha(Request $request, Reservas $reserva){



      $validate = $request->validate([
        'Fecha_inicio' => 'required',
        'Fecha_fin' => 'required',
        'Motivo'=>'required',
        'Laboratorio_id'=>'required',
        'Modulos'=>'required',
        'Laboratorio_id'=>'required',
        'Usuario_id'=>'required',


      ]);

    if($validate['Fecha_inicio']> $validate['Fecha_fin']){
      return back()->with('failure', 'Error!. La fecha de Inicio debe ser Menor a la Fecha Final');

    }
    if($validate['Fecha_fin']< $validate['Fecha_inicio']){
      return back()->with('failure', 'Error!. La fecha de Fin debe ser Maytor a la Fecha Final');

    }

    $ModulosTotales = $reserva->Modulos;
    if($reserva->Fecha_inicio >= $validate['Fecha_fin']){//verificar cuando el inicio y final es antes del antiguo inicio
        $Fecha_i= $validate['Fecha_inicio'];
        $Fecha_f = $validate['Fecha_fin'];
        $datos = $this->verificar_disp($Fecha_i,$Fecha_f,$ModulosTotales,$validate);
        if($datos){
            return back()->with(compact('datos')); 
        };            
        $eventos = Event::where('id_reserva',$reserva->id)
        ->whereDate('start','>=',$reserva->Fecha_inicio)
        ->whereDate('start','<=',$reserva->Fecha_fin)
        ->get();
        $ArregloEvento=$eventos->toArray();
        foreach ($ArregloEvento as $evento) {
            $codigo = $evento['id'];
            Event::destroy($codigo);
        }
        $this->guardado($Fecha_i,$ModulosTotales,$Fecha_f,$validate,$reserva );
    }

    
    elseif($reserva->Fecha_fin <= $validate['Fecha_fin']){      //Revisa Si la Fecha final original es menor o igual a la Fecha Fin nueva
        $Fecha_i= $validate['Fecha_inicio'];
        $Fecha_f = $validate['Fecha_fin'];
        $datos = $this->verificar_disp($Fecha_i,$Fecha_f,$ModulosTotales,$validate);
        if($datos){
            return back()->with(compact('datos')); 
        };            
        $eventos = Event::where('id_reserva',$reserva->id)
        ->whereDate('start','>=',$reserva->Fecha_inicio)
        ->whereDate('start','<=',$reserva->Fecha_fin)
        ->get();
        $ArregloEvento=$eventos->toArray();
        foreach ($ArregloEvento as $evento) {
            $codigo = $evento['id'];
            Event::destroy($codigo);
        }
        $this->guardado($Fecha_i,$ModulosTotales,$Fecha_f,$validate,$reserva );
    }
    else{

        if($reserva->Fecha_inicio > $validate['Fecha_inicio']){      //Revisa si la Fecha de Inicio Original es mayor a la fecha del fomrulario
            $Fecha_i= $validate['Fecha_inicio'];
            $Fecha_f = Carbon::parse($reserva->Fecha_inicio)->addDays(-1);            //Se resta un día del índice
            $datos = $this->verificar_disp($Fecha_i,$Fecha_f,$ModulosTotales,$validate);
            if($datos){
                return back()->with(compact('datos')); 
            }; 
        }

        if($reserva->Fecha_fin < $validate['Fecha_fin']){          //Revisa si la fecha final de origen es menor a la Fecha Fin ingresada del formulario
            $Fecha_i= Carbon::parse($reserva->Fecha_fin)->addDays(1);
            $Fecha_f = $validate['Fecha_fin'];
            $datos = $this->verificar_disp($Fecha_i,$Fecha_f,$ModulosTotales,$validate);
            if($datos){
                return back()->with(compact('datos')); 
            }; 
        }
        if($reserva->fecha_inicial > $validate['Fecha_inicio']){         //Comprueba si está correctamente la Fecha original con la nueva
            $Fecha_i= $validate['Fecha_inicio'];
            $Fecha_f = $reserva->Fecha_inicio;
            $this->guardado($Fecha_i,$ModulosTotales,$Fecha_f,$validate,$reserva );
        }
        if($reserva->Fecha_fin < $validate['Fecha_fin']){               //Recorre hasta la fecha Final
            $Fecha_i= $reserva->Fecha_fin;
            $Fecha_f = $validate['Fecha_fin'];
            $this->guardado($Fecha_i,$ModulosTotales,$Fecha_f,$validate,$reserva );
        }
        if($reserva->Fecha_inicio < $validate['Fecha_inicio']){          //Recorre hasta la fecha inicial
            $eventos = Event::where('reserva_id',$reserva->id)
            ->whereDate('start','>=',$reserva->Fecha_inicio)
            ->whereDate('start','<',$validate['Fecha_inicio'])
            ->get();
            $ArregloEvento=$eventos->toArray();
            foreach ($ArregloEvento as $evento) {
                $codigo = $evento['id'];
                Event::destroy($codigo);
            }
        }
        if($reserva->Fecha_fin > $validate['Fecha_fin']){              //Fecha final hasta el final
            $eventos = Event::where('reserva_id',$reserva->id)
            ->whereDate('start','>',$validate['Fecha_fin'])
            ->whereDate('start','<=',$reserva->Fecha_fin)
            ->get();
            $ArregloEvento=$eventos->toArray();
            foreach ($ArregloEvento as $evento) {
              $codigo = $evento['id'];
              Event::destroy($codigo);
            }
        }
    }
          $reserva->Fecha_inicio = $validate['Fecha_inicio'];
          $reserva->Fecha_fin = $validate['Fecha_fin'];
          $reserva->save();
          return back()->with('success', 'CORRECTO!. La fecha se ha cambiado Correctamente');
          





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
}
