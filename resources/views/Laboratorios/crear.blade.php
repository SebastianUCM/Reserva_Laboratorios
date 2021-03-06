
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
                <div class="card-header text-white card-dark bg-primary ">{{ __('Crear un Laboratorio') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/Laboratorios') }}">
                    {{ csrf_field() }}

                        <div class="form-group row">

                            <label for="Name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Laboratorio') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="Nombre" value="{{ old('name') }}" required autocomplete="Nombre" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="Carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="codigo" id="codigo" size=1>
                                    @foreach($carreras as $carrera)
                                        <option value="{{$carrera->codigo}}" >{{$carrera->nombre}}</option> 
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="Capacidad" class="col-md-4 col-form-label text-md-right">{{ __('Capacidad') }}</label>

                            <div class="col-md-6">
                                <input id="Capacidad" type="number" min="1" pattern="^[0-9]+" class="form-control @error('password') is-invalid @enderror" name="Capacidad" required autocomplete="Capacidad">
                            </div>

                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear Laboratorio') }}
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
