@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary "">{{ __('Listado de Laboratorios') }}
                <ul class="navbar-nav ml-auto">
                                <a href="/Laboratorios/create" class="btn btn-success">Crear un Laboratorio</a>
                </ul>
                                </div>

               
                    <table class="table table-light ">
                        <thead class="thead-light ">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Carrera</th>
                                <th>Capacidad</th>
                                <th>Accion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($laboratorios as $laboratorio)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$laboratorio->Nombre}}</td>
                                <td>{{$laboratorio->Carrera}}</td>
                                <td>{{$laboratorio->Capacidad}}</td>
                                <td>
                                <form method="post" action="{{url('/Laboratorios/'.$laboratorio->id.'/edit')}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                                </td>
                                <td>
                                <form method="post" action="{{url('/laboratorios/'.$laboratorio->id)}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Borrar?');">Borrar</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
