Idndex Reserva
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary ">{{ __('Listado de Reservas') }}
                    <ul class="navbar-nav ml-auto">
                        <a href="/Reservas/create" class="btn btn-success">Crear una Reserva</a>
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
                        
                        //foreach

                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
