
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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Listado de Reservas') }}
                    <ul class="navbar-nav ml-auto">
                        @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a')
                            <a href="/Reservas/create" class="btn btn-success">Crear una Reserva</a>
                        @endif
                    </ul>
                </div>
                <table class="table table-light">
                        <thead class="thead-light ">
                            <tr>
                                <th>N°Lista</th>
                                <th>Laboratorio</th>
                                <th>Fecha</th>
                                <th>Hora Inicio</th>
                                <th>Hora Término</th>
                                <th>Motivo</th>
                                <th>Usuario</th>
                                @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a')
                                <th>Acción</th>
                                <th>Acción</th>
                                @endif

                            </tr>
                        </thead>
                        @foreach($reservas as $reserva)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$reserva->Laboratorio}}</td>
                            <td>{{$reserva->Fecha}}</td>
                            <td>{{$reserva->Modulo_inicio}}</td>
                            <td>{{$reserva->Modulo_fin}}</td>
                            <td>{{$reserva->Motivo}}</td>
                            <td>{{$reserva->Usuario}}</td>
                            @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a')
                            <td>
                                <form method="GET" action="/Reservas/{{$reserva->id}}/edit">
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="/Reservas/{{$reserva->id}}">
                                    {{csrf_field()}}
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Borrar?');">Eliminar</button>
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
