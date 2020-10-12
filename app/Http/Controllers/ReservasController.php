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

    public function index_C(){

        $month = date("Y-m");
        //
        $data = $this->calendar_month($month);
        $mes = $data['month'];
        // obtener mes en espanol
        $mespanish = $this->spanish_month($mes);
        $mes = $data['month'];
 
        return view("Calendario/index",[
          'data' => $data,
          'mes' => $mes,
          'mespanish' => $mespanish
        ]);
 
    }
 
    public function index_month($month){
 
       $data = $this->calendar_month($month);
       $mes = $data['month'];
       // obtener mes en espanol
       $mespanish = $this->spanish_month($mes);
       $mes = $data['month'];
 
       return view("Calendario/index",[
         'data' => $data,
         'mes' => $mes,
         'mespanish' => $mespanish
       ]);
 
     }
 
     public static function calendar_month($month){
       //$mes = date("Y-m");
       $mes = $month;
       //sacar el ultimo de dia del mes
       $daylast =  date("Y-m-d", strtotime("last day of ".$mes));
       //sacar el dia de dia del mes
       $fecha      =  date("Y-m-d", strtotime("first day of ".$mes));
       $daysmonth  =  date("d", strtotime($fecha));
       $montmonth  =  date("m", strtotime($fecha));
       $yearmonth  =  date("Y", strtotime($fecha));
       // sacar el lunes de la primera semana
       $nuevaFecha = mktime(0,0,0,$montmonth,$daysmonth,$yearmonth);
       $diaDeLaSemana = date("w", $nuevaFecha);
       $nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
       $dateini = date ("Y-m-d",$nuevaFecha);
       //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
       // numero de primer semana del mes
       $semana1 = date("W",strtotime($fecha));
       // numero de ultima semana del mes
       $semana2 = date("W",strtotime($daylast));
       // semana todal del mes
       // en caso si es diciembre
       if (date("m", strtotime($mes))==12) {
           $semana = 5;
       }
       else {
         $semana = ($semana2-$semana1)+1;
       }
       // semana todal del mes
       $datafecha = $dateini;
       $calendario = array();
       $iweek = 0;
       while ($iweek < $semana):
           $iweek++;
           //echo "Semana $iweek <br>";
           //
           $weekdata = [];
           for ($iday=0; $iday < 7 ; $iday++){
             // code...
             $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
             $datanew['mes'] = date("M", strtotime($datafecha));
             $datanew['dia'] = date("d", strtotime($datafecha));
             $datanew['fecha'] = $datafecha;
             //AGREGAR CONSULTAS EVENTO
             $datanew['reservas'] = Reservas::where("fecha",$datafecha)->get();
 
             array_push($weekdata,$datanew);
           }
           $dataweek['semana'] = $iweek;
           $dataweek['datos'] = $weekdata;
           //$datafecha['horario'] = $datahorario;
           array_push($calendario,$dataweek);
       endwhile;
       $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
       $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
       $month = date("M",strtotime($mes));
       $yearmonth = date("Y",strtotime($mes));
       //$month = date("M",strtotime("2019-03"));
       $data = array(
         'next' => $nextmonth,
         'month'=> $month,
         'year' => $yearmonth,
         'last' => $lastmonth,
         'calendar' => $calendario,
       );
       return $data;
     }
 
     public static function spanish_month($month)
     {
 
         $mes = $month;
         if ($month=="Jan") {
           $mes = "Enero";
         }
         elseif ($month=="Feb")  {
           $mes = "Febrero";
         }
         elseif ($month=="Mar")  {
           $mes = "Marzo";
         }
         elseif ($month=="Apr") {
           $mes = "Abril";
         }
         elseif ($month=="May") {
           $mes = "Mayo";
         }
         elseif ($month=="Jun") {
           $mes = "Junio";
         }
         elseif ($month=="Jul") {
           $mes = "Julio";
         }
         elseif ($month=="Aug") {
           $mes = "Agosto";
         }
         elseif ($month=="Sep") {
           $mes = "Septiembre";
         }
         elseif ($month=="Oct") {
           $mes = "Octubre";
         }
         elseif ($month=="Nov") {
           $mes = "Noviembre";
         }
         elseif ($month=="Dec") {
           $mes = "Diciembre";
         }
         else {
           $mes = $month;
         }
         return $mes;
     }
}
