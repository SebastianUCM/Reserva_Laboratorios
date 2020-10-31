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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Crear una Reserva') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/Reservas') }}">
                    {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="Fecha_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Inicio') }}</label>
                            <div class="col-md-6">
                                <input type="date" id="Fecha_inicio" class="form-control" name="Fecha_inicio" value="<?php echo date("d-m-Y\TH-i");?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Fecha_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Fin') }}</label>
                            <div class="col-md-6">
                                <input type="date" id="Fecha_fin" class="form-control" name="Fecha_fin" value="<?php echo date("d-m-Y\TH-i");?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo') }}</label>
                            <div class="col-md-6">
                                <input id="Motivo" type="text" class="form-control" name="Motivo" value="{{ old('name') }}" required autocomplete="Motivo" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="Laboratorio_id" class="col-md-4 col-form-label text-md-right">{{ __('Laboratorio') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="Laboratorio_id" id="Laboratorio_id" size=1>
                                    @foreach($laboratorios as $laboratorio)
                                        <option value="{{$laboratorio->id}}" >{{$laboratorio->Nombre}}</option> 
                                    @endforeach
                                </select>
                            </div>

                        </div>


                        <div class="form-group row">

                            <label type="hidden" for="Usuario_id" class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="Usuario_id" value="@auth{{ auth()->user()->id}}@endauth" readonly>
                                <input type="text" class="form-control"  value="@auth{{ auth()->user()->name}}@endauth" readonly>
                            </div>
                        </div>
                        <!--


                        <div class="form-group row">
                            <label for="Usuario_id" class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>
                                <div class="col-md-6">   
                                    @auth
                                    {{ auth()->user()->name   }}
                                    @endauth
                                </div>

                        </div> !-->
                        <div class="card ">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 >
                                        Lunes
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>Modulos: </label>
                                        <br>
                                        <input type="checkbox" name="Modulos[]" value =1> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="Modulos[]" value =2> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="Modulos[]" value =3> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="Modulos[]" value =4> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="Modulos[]" value =5> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="Modulos[]" value =6> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="Modulos[]" value =7> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="Modulos[]" value =8> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="Modulos[]" value =9> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="Modulos[]" value =10> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="Modulos[]" value =11> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="Modulos[]" value =12> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 >
                                        Martes
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>Modulos: </label>
                                        <br>
                                        <input type="checkbox" name="Modulos[]" value =13> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="Modulos[]" value =14> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="Modulos[]" value =15> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="Modulos[]" value =16> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="Modulos[]" value =17> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="Modulos[]" value =18> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="Modulos[]" value =19> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="Modulos[]" value =20> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="Modulos[]" value =21> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="Modulos[]" value =22> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="Modulos[]" value =23> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="Modulos[]" value =24> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 >
                                        Miercoles
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>Modulos: </label>
                                        <br>
                                        <input type="checkbox" name="Modulos[]" value =25> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="Modulos[]" value =26> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="Modulos[]" value =27> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="Modulos[]" value =28> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="Modulos[]" value =29> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="Modulos[]" value =30> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="Modulos[]" value =31> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="Modulos[]" value =32> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="Modulos[]" value =33> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="Modulos[]" value =34> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="Modulos[]" value =35> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="Modulos[]" value =36> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 >
                                        Jueves
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>Modulos: </label>
                                        <br>
                                        <input type="checkbox" name="Modulos[]" value =37> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="Modulos[]" value =38> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="Modulos[]" value =39> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="Modulos[]" value =40> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="Modulos[]" value =41> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="Modulos[]" value =42> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="Modulos[]" value =43> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="Modulos[]" value =44> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="Modulos[]" value =45> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="Modulos[]" value =46> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="Modulos[]" value =47> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="Modulos[]" value =48> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 >
                                        Viernes
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>Modulos: </label>
                                        <br>
                                        <input type="checkbox" name="Modulos[]" value =49> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="Modulos[]" value =50> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="Modulos[]" value =51> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="Modulos[]" value =52> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="Modulos[]" value =53> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="Modulos[]" value =54> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="Modulos[]" value =55> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="Modulos[]" value =56> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="Modulos[]" value =57> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="Modulos[]" value =58> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="Modulos[]" value =59> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="Modulos[]" value =60> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="panel panel-success autocollapse">
                                <div class="button button1 clickable">
                                    <h4 >
                                        Sábado
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <label>Modulos: </label>
                                        <br>
                                        <input type="checkbox" name="Modulos[]" value =61> 1- 08:30 - 09:30<br />
                                        <input type="checkbox" name="Modulos[]" value =62> 2- 09:35 - 10:35<br />
                                        <input type="checkbox" name="Modulos[]" value =63> 3- 10:50 - 11:50<br />
                                        <input type="checkbox" name="Modulos[]" value =64> 4- 11:55 - 12:55<br />
                                        <input type="checkbox" name="Modulos[]" value =65> 5- 13:10 - 14:10<br />
                                        <input type="checkbox" name="Modulos[]" value =66> 6- 14:30 - 15:30<br />
                                        <input type="checkbox" name="Modulos[]" value =67> 7- 15:35 - 16:35<br />
                                        <input type="checkbox" name="Modulos[]" value =68> 8- 16:50 - 17:50<br />
                                        <input type="checkbox" name="Modulos[]" value =69> 9- 17:55 - 18:55<br />
                                        <input type="checkbox" name="Modulos[]" value =70> 10- 19:10 - 20:10<br />
                                        <input type="checkbox" name="Modulos[]" value =71> 11- 20:15 - 21:15<br />
                                        <input type="checkbox" name="Modulos[]" value =72> 12- 21:30 - 22:30<br />
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                        
               
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear una Reserva') }}
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