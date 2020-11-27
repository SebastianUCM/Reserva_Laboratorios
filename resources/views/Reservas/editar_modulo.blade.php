
    <style>
        .bg 
        {
            background: url('/image/blanco.jpg');
            height: 100%;
            width: 100%;
            padding-right: auto;
            padding-left: auto;
            margin-right: auto;
            margin-left: auto;
        }
    </style>



<div class="bg">
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    @if ($message = Session::get('failure'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Crear una Reserva') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/Reservas/'.$reserva->id.'/Modulos_update')}}">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-group row">
                            <label for="Fecha_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicio') }}</label>
                            <div class="col-md-6">
                                <input type="date" id="Fecha_inicio" class="form-control" name="Fecha_inicio" value="{{$reserva->Fecha_inicio}}" required="true" readonly>
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="Fecha_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Fin') }}</label>
                            <div class="col-md-6">
                                <input type="date" id="Fecha_fin" class="form-control" name="Fecha_fin" value="{{$reserva->Fecha_fin}}" required="true" readonly>
                            </div>
                    </div>

                        <div class="form-group row">
                            <label for="Motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo') }}</label>
                            <div class="col-md-6">
                                <input id="Motivo" type="text" class="form-control" name="Motivo" value="{{ $reserva->Motivo }}" required autocomplete="Motivo" autofocus readonly>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Laboratorio_id" class="col-md-4 col-form-label text-md-right">{{ __('Laboratorio') }}</label>
                            <div class="col-md-6">
                                <input id="Laboratorio_id" type="text" class="form-control" name="Laboratorio_id" value="{{ $reserva->Laboratorio_id }}"  required autocomplete="Laboratorio_id" autofocus readonly readonly>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label type="hidden" for="Usuario_id" class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="Usuario_id" value="@auth{{ auth()->user()->id}}@endauth" readonly>
                                <input type="text" class="form-control"  value="@auth{{ auth()->user()->name}}@endauth" readonly>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">Módulo</th>
                                <th scope="col">Lunes</th>
                                <th scope="col">Martes</th>
                                <th scope="col">Miércoles</th>
                                <th scope="col">Jueves</th>
                                <th scope="col">Viernes</th>
                                <th scope="col">Sábado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1.- 8:30 - 9:30</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =1 @if(in_array("1", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =13 @if(in_array("13", $reserva->Modulos)) checked @endif ><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =25 @if(in_array("25", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =37 @if(in_array("37", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =49 @if(in_array("49", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =61 @if(in_array("61", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2.- 09:35 - 10:35</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =2 @if(in_array("2", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =14 @if(in_array("14", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =26 @if(in_array("26", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =38 @if(in_array("38", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =50 @if(in_array("50", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =62 @if(in_array("62", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3.- 10:50 - 11:50</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =3 @if(in_array("3", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =15 @if(in_array("15", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =27 @if(in_array("27", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =39 @if(in_array("39", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =51 @if(in_array("51", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =63 @if(in_array("63", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4.- 11:55 - 12:55</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =4 @if(in_array("4", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =16 @if(in_array("16", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =28 @if(in_array("28", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =40 @if(in_array("40", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =52 @if(in_array("52", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =64 @if(in_array("64", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5.- 13:10 - 14:10</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =5 @if(in_array("5", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =17 @if(in_array("17", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =29 @if(in_array("29", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =41 @if(in_array("41", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =53 @if(in_array("53", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =65 @if(in_array("65", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">6.- 14:30 - 15:30</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =6 @if(in_array("6", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =18 @if(in_array("18", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =30 @if(in_array("30", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =42 @if(in_array("42", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =54 @if(in_array("54", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =66 @if(in_array("66", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">7.- 15:35 - 16:35</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =7 @if(in_array("7", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =19 @if(in_array("19", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =31 @if(in_array("31", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =43 @if(in_array("43", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =55 @if(in_array("55", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =67 @if(in_array("67", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                <tr>
                                    <th scope="row">8.- 16:50 - 17:50</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =8 @if(in_array("8", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =20 @if(in_array("20", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =32 @if(in_array("32", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =44 @if(in_array("44", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =56 @if(in_array("56", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =68 @if(in_array("68", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">9.- 17:55 - 18:55</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =9 @if(in_array("9", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =21 @if(in_array("21", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =33 @if(in_array("33", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =45 @if(in_array("45", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =57 @if(in_array("57", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =69 @if(in_array("69", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10.- 19:10 - 20:10</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =10 @if(in_array("10", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =22 @if(in_array("22", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =34 @if(in_array("34", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =46 @if(in_array("46", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =58 @if(in_array("58", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =70 @if(in_array("70", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>      
                                <tr>
                                    <th scope="row">11.- 20:15 - 21:15</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =11 @if(in_array("11", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =23 @if(in_array("23", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =35 @if(in_array("35", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =47 @if(in_array("47", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =59 @if(in_array("59", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =71 @if(in_array("71", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>    
                                <tr>
                                    <th scope="row">12.- 21:30 - 22:30</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =12 @if(in_array("12", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =24 @if(in_array("24", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =36 @if(in_array("36", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =48 @if(in_array("48", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =60 @if(in_array("60", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =72 @if(in_array("72", $reserva->Modulos)) checked @endif><br />
                                    </td>
                                </tr>   
                            </tbody>
                        </table>
               
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar Reserva') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
