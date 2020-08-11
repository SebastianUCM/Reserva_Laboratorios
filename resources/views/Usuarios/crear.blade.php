crear usuario
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white card-dark bg-primary "">{{ __('Crear un Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/Usuarios') }}">
                    {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="Name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>


                        </div>

                        <div class="form-group row">
                            <label for="Carrera" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            

 
                        </div>

                        <div class="form-group row">
                            <label for="Capacidad" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                            
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear Usuario') }}
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
