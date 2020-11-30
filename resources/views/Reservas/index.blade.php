
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Listado de Reservas') }}
                    <ul class="navbar-nav ml-auto">
                        @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a' or Auth::user()->rol == 'Administrador'or Auth::user()->rol == 'Alumno' or Auth::user()->rol == 'Profesor')
                            <a href="/Reservas/create" class="btn btn-success">Crear una Reserva</a>
                        @endif
                    </ul>

                    <ul class="navbar-nav ml-auto">
                    <form class="form-inline">
                        @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a' or Auth::user()->rol == 'Administrador'or Auth::user()->rol == 'Alumno' or Auth::user()->rol == 'Profesor')
                        <!--<input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search"> !-->
                        <select class="form-control mr-2" name="Laboratorio_id" id="Laboratorio_id" size=1>
                        <option selected="false" disabled="disabled">--SELECCIONE UNA OPCIÓN--</option>
                        @foreach($laboratorios as $laboratorio)
                            <option value="{{$laboratorio->id}}">{{$laboratorio->Nombre}}</option>
                            
                        @endforeach
                        </select>
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
                        <a href="/Reservas" class="btn btn-danger">Quitar Busqueda</a>
                        
                        </form>
                        @endif
                    </ul>



                </div>
                <table class="table table-light">
                        <thead class="thead-light ">
                            <tr>
                                <th>N°Lista</th>
                                <th>Laboratorio</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Motivo</th>
                                <th>Modulos</th>
                                <th>Usuario</th>
                                @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a' or Auth::user()->rol == 'Administrador'or Auth::user()->rol == 'Alumno' or Auth::user()->rol == 'Profesor')
                                <th>Editar</th>
                                <th>Acción</th>
                                @endif

                            </tr>
                        </thead>
                        @foreach($resevs as $resev)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$resev->Laboratorio}}</td>
                            <td>{{date('d-m-Y', strtotime($resev->Fecha_inicio))}}</td>
                            <td>{{date('d-m-Y', strtotime($resev->Fecha_fin))}}</td>
                            <td>{{$resev->Motivo}}</td>
                            <td> 

                                <ul>
                                @php ($array = json_decode($resev->Modulos, true))
                                @foreach($array as $modulo)

                                @if($modulo>=1 && $modulo<=12)
                                    <li>Lunes: {{ $modulo }}</li>
                                @endif

                                @if($modulo>=13 && $modulo<=24)
                                    <li>Martes: {{ $modulo-12 }}</li>
                                @endif


                                @if($modulo>=25 && $modulo<=36)
                                    <li>Miercoles: {{ $modulo-24}}</li>
                                @endif

                                @if($modulo>=37 && $modulo<=48)
                                    <li>Jueves: {{ $modulo-36}}</li>
                                @endif

                                @if($modulo>=49 && $modulo<=60)
                                    <li>Viernes: {{ $modulo-48}}</li>
                                @endif

                                @if($modulo>=61 && $modulo<=72)
                                    <li>Sabado: {{ $modulo-60}}</li>
                                @endif
                                @endforeach
                                </ul></td>
                            <td>{{$resev->Usuario}}</td>

                            
                            @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a' or Auth::user()->rol == 'Administrador'or Auth::user()->rol == 'Alumno' or Auth::user()->rol == 'Profesor')
                            <td>
                                <form method="GET" action="/Reservas/{{$resev->id}}/ModFechas">
                                    <button type="submit" class="btn btn-warning">Fecha</button>
                                </form>
                                <form method="GET" action="{{ url('/Reservas/'.$resev->id.'/Modulos')}}">
                                    <button type="submit" class="btn btn-warning">Modulos</button>
                                </form>
                            </td>


                            <td>
                                <form method="POST" action="/Reservas/{{$resev->id}}">
                                    {{csrf_field()}}
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Borrar?');">Eliminar</button>
                                </form>
                                <form method="GET" action="/Reservas/{{$resev->id}}/desactivar">
                                    <button type="submit" class="btn btn-Secondary">Desact.Fecha</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
