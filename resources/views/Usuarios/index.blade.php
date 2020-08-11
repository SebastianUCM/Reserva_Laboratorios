
home usuario
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Listado de Usuarios') }}
                    <ul class="navbar-nav ml-auto">
                        <a href="/Usuarios/create" class="btn btn-success">Crear un Usuario</a>
                    </ul>
                </div>
                <table class="table table-light ">
                        <thead class="thead-light ">
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Correo Electronico</th>
                                <th>Rol</th>
                                <th>Accion</th>
                                <th>Accion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td></td>
                                <td>
                                <form method="GET" action="/Usuarios/{{$usuario->id}}/edit">
                                <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                                </td>
                                <td>
                                <form method="POST" action="/Usuarios/{{$usuario->id}}">
                                {{csrf_field()}}
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Borrar?');">Eliminar</button>
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