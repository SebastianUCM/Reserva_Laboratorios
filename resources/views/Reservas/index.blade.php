Idndex Reserva
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Listado de Reservas') }}
                    <ul class="navbar-nav ml-auto">
                        <a href="/Reservas/create" class="btn btn-success">Crear una Reserva</a>
                    </ul>
                </div>
                <table class="table table-light ">
                        <thead class="thead-light ">
                            <tr>
                                <th>N°Lista:</th>
                                <th>Laboratorio:</th>
                                <th>Fecha:</th>
                                <th>Hora Inicio:</th>
                                <th>Hora Término:</th>
                                <th>Motivo:</th>
                                <th>Usuario:</th>
                                <th>Acción</th>
                                <th>Acción</th>

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
                        </tr>

                        @endforeach
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
