
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
                <div class="card-header text-white card-dark bg-primary ">{{ __('Crear una Reserva') }}</div>

                <div class="card-body">
                    <form method="POST" action="/Reservas/{{$reserva->id}}">
                    {{ csrf_field() }}
                    @method('PUT')
                        <div class="form-group row">
                            <label for="Fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
                            <div class="col-md-6">
                                <input type="date" id="Fecha" class="form-control" name="Fecha" min="2020-08-11" max="2020-12-31" value="{{ $reserva->Fecha }}">
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="Modulo_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Modulo de Inicio') }}</label>

                            <div class="col-md-6">
                                <input id="Modulo_inicio" type="time" class="form-control" name="Modulo_inicio" required autocomplete="Modulo_inicio" value="{{ $reserva->Modulo_inicio }}" autofocus>
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="Modulo_fin" class="col-md-4 col-form-label text-md-right">{{ __('Modulo de Termino') }}</label>

                            <div class="col-md-6">
                                <input id="Modulo_fin" type="time" class="form-control" name="Modulo_fin" required autocomplete="Modulo_fin" value="{{ $reserva->Modulo_fin }}" autofocus>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="Motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo') }}</label>
                            <div class="col-md-6">
                                <input id="Motivo" type="text" class="form-control" name="Motivo" value="{{ $reserva->Motivo }}" required autocomplete="Motivo" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="Laboratorio_id" class="col-md-4 col-form-label text-md-right">{{ __('Laboratorio') }}</label>

                            <div class="col-md-6">
                                <input id="Laboratorio_id" type="text" class="form-control" name="Laboratorio_id" value="{{ $reserva->Laboratorio_id }}"  required autocomplete="Laboratorio_id" autofocus readonly>
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="Usuario_id" class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>

                            <div class="col-md-6">
                                <input id="Usuario_id" type="text" class="form-control" name="Usuario_id" value="{{ $reserva->Usuario_id }}" required autocomplete="Usuario_id" autofocus readonly>
                            </div>

                        </div>
               
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar Reserva') }}
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
