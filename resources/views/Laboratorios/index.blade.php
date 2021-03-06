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
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Listado de Laboratorios') }}
                    <ul class="navbar-nav ml-auto">
                    @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a'or Auth::user()->rol == 'Administrador')
                        <a href="/Laboratorios/create" class="btn btn-success">Crear un Laboratorio</a>
                    @endif
                    </ul>
                </div>

                    <table class="table table-light ">
                        <thead class="thead-light ">
                            <tr>
                                <th>N°Lista</th>
                                <th>Nombre</th>
                                <th>Carrera</th>
                                <th>Capacidad</th>
                                @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a'or Auth::user()->rol == 'Administrador')
                                <th>Accion</th>
                                <th>Accion</th>
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($laboratorios as $laboratorio)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$laboratorio->Nombre}}</td>
                                <td>{{$laboratorio->Codigo}}</td>
                                <td>{{$laboratorio->Capacidad}}</td>
                                @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a'or Auth::user()->rol == 'Administrador')
                                <td>
                                    <form method="GET" action="/Laboratorios/{{$laboratorio->id}}/edit">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="/Laboratorios/{{$laboratorio->id}}">
                                    {{csrf_field()}}
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Borrar?');">Eliminar</button>
                                
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
