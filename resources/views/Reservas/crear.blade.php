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
                    <form method="POST" action="{{ url('/Reservas') }}">
                    {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="Fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
                            <div class="col-md-6">
                                <input type="date" id="Fecha" class="form-control" name="Fecha" min="2020-08-14" max="2020-12-31">
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="Modulo_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Modulo de Inicio') }}</label>

                            <div class="col-md-6">
                                <input id="Modulo_inicio" type="time" class="form-control" name="Modulo_inicio" required autocomplete="Modulo_inicio" autofocus>
                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="Modulo_fin" class="col-md-4 col-form-label text-md-right">{{ __('Modulo de Termino') }}</label>

                            <div class="col-md-6">
                                <input id="Modulo_fin" type="time" class="form-control" name="Modulo_fin" required autocomplete="Modulo_fin" autofocus>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="Motivo" class="col-md-4 col-form-label text-md-right">{{ __('Motivo') }}</label>
                            <div class="col-md-6">
                                <input id="Motivo" type="text" class="form-control" name="Motivo" value="{{ old('name') }}" required autocomplete="Motivo" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="Laboratorio_id" class="col-md-4 col-form-label text-md-right">{{ __('Laboratorio') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="Laboratorio_id" id="Laboratorio_id" size=1>
                                    @foreach($laboratorios as $laboratorio)
                                        <option value="{{$laboratorio->id}}" >{{$laboratorio->Nombre}}</option> 
                                    @endforeach
                                </select>
                            </div>

                        </div>


                        <div class="form-group row">

                            <label type="hidden" for="Usuario_id" class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="Usuario_id" value="@auth{{ auth()->user()->id}}@endauth" readonly>
                                <input type="text" class="form-control"  value="@auth{{ auth()->user()->name}}@endauth" readonly>
                            </div>
                        </div>
                        <!--


                        <div class="form-group row">
                            <label for="Usuario_id" class="col-md-4 col-form-label text-md-right">{{ __('Encargado') }}</label>
                                <div class="col-md-6">   
                                    @auth
                                    {{ auth()->user()->name   }}
                                    @endauth
                                </div>

                        </div> !-->
               
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear una Reserva') }}
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