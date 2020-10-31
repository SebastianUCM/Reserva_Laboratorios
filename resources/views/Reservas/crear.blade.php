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
                                <input type="date" id="Fecha_inicio" class="form-control" name="Fecha_inicio" value="<?php echo date("d-m-Y\TH-i");?>" required="true">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Fecha_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Fin') }}</label>
                            <div class="col-md-6">
                                <input type="date" id="Fecha_fin" class="form-control" name="Fecha_fin" value="<?php echo date("d-m-Y\TH-i");?>" required="true">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo') }}</label>
                            <div class="col-md-6">
                                <input id="Motivo" type="text" class="form-control" name="Motivo" value="{{ old('name') }}" required autocomplete="Motivo" autofocus required="true">

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
                        <!-- Tabla Horario -->
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
                                        <input type="checkbox" name="Modulos[]" value =1><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =13><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =25><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =37><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =49><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =61><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2.- 09:35 - 10:35</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =2><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =14><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =26><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =38><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =50><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =62><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3.- 10:50 - 11:50</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =3><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =15><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =27><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =39><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =51><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =63><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4.- 11:55 - 12:55</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =4><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =16><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =28><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =40><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =52><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =64><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5.- 13:10 - 14:10</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =5><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =17><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =29><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =41><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =53><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =65><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">6.- 14:30 - 15:30</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =6><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =18><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =30><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =42><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =54><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =66><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">7.- 15:35 - 16:35</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =7><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =19><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =31><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =43><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =55><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =67><br />
                                    </td>
                                <tr>
                                    <th scope="row">8.- 16:50 - 17:50</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =8><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =20><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =32><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =44><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =56><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =68><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">9.- 17:55 - 18:55</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =9><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =21><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =33><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =45><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =57><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =69><br />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10.- 19:10 - 20:10</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =10><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =22><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =34><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =46><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =58><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =70><br />
                                    </td>
                                </tr>      
                                <tr>
                                    <th scope="row">11.- 20:15 - 21:15</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =11><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =23><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =35><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =47><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =59><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =71><br />
                                    </td>
                                </tr>    
                                <tr>
                                    <th scope="row">12.- 21:30 - 22:30</th>
                                    <!-- Lunes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =12><br />
                                    </td>
                                    <!-- Martes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =24><br />
                                    </td>
                                    <!-- Miercoles -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =36><br />
                                    </td>
                                    <!-- Jueves -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =48><br />
                                    </td>
                                    <!-- Viernes -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =60><br />
                                    </td>
                                    <!-- Sabado -->
                                    <td>
                                        <input type="checkbox" name="Modulos[]" value =72><br />
                                    </td>
                                </tr>   
                            </tbody>
                        </table>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear Reserva') }}
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