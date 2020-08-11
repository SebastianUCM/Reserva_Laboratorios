editar laboratorio
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary "">{{ __('Editar un Laboratorio') }}</div>

                <div class="card-body">
                    <form method="POST" action="/Laboratorios/{{$laboratorio->id}}">
                    {{ csrf_field() }}
                    @method('PUT')
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="Name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Laboratorio') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="Nombre" value="{{ $laboratorio->Nombre }}" required autocomplete="Nombre" autofocus>

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
                                <input id="Carrera" type="text" class="form-control @error('name') is-invalid @enderror" name="Carrera" value="{{ $laboratorio->Carrera }}" required autocomplete="Carrera">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Capacidad" class="col-md-4 col-form-label text-md-right">{{ __('Capacidad') }}</label>

                            <div class="col-md-6">
                                <input id="Capacidad" type="interger" class="form-control @error('password') is-invalid @enderror" name="Capacidad" value="{{ $laboratorio->Capacidad }}" required autocomplete="Capacidad">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar Laboratorio') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
