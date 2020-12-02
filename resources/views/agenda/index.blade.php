
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href='fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='fullcalendar/lib/main.js'></script>
    <script src='fullcalendar/lib/locales/es.js'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'America/Santiago',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                customButtons:{
                  MiBoton:{
                    text:"Botón",
                    click:function(){
                      alert("Hola Mundo");
                      $('#exampleModal').modal();
                    }

                  }
                },
                dateClick:function(info){
                  $('#txtFecha').val(info.dateStr);
                  $('#exampleModal').modal();
                  console.log(info);
                  //calendar.addEvent({ title:"EventoX", date:info.dateStr });
                },
                eventClick:function(info){
                  console.log(info);
                  console.log(info.event.id);
                  console.log(info.event.title);
                  console.log(info.event.modulo);
                  console.log(info.event.reserva_id);
                  console.log(info.event.usuario_id);
                  console.log(info.event.laboratorio_id);



                  $('#txtID').val(info.event.id);
                  $('#txtTMotivo').val(info.event.title);
                  $('#txtFecha').val(info.event.dateStr);
                  $('#txtmodulos').val(info.event.extendedProps.modulo);
                  $('#txtUsuario_id').val(info.event.extendedProps.usuario_id);
                  $('#txtlaboratorio_id').val(info.event.extendedProps.laboratorio_id);
                  $('#txtReserva_id').val(info.event.extendedProps.reserva_id);
                  $('#exampleModal').modal();



                },
                locale: 'es',
                events: {!! json_encode($eventos) !!}
            });
            calendar.render();
            function recolectarDatosGUI(method){
              nuevoEvento={
                id:$('#txtID').val(),
                title:$('#txtTitulo').val(),
                start:$('#txtFecha').val(),
                modulo:$('#txtmodulos').val(),
                usuario_id:$('#txtUsuario_id').val(),
                laboratorio_id:$('#txtlaboratorio_id').val(),
                reserva_id:$('#txtReserva_id').val(),
              }
            }
        });

    </script>

  </head>
  <div class="row">
        <div class="col"></div>
        <div class="col-7">

        @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a' or Auth::user()->rol == 'Administrador'or Auth::user()->rol == 'Alumno' or Auth::user()->rol == 'Profesor')
        <form class="form-inline">
          <div class="col-xs-6">
            <select class="form-control mr-2" name="id" id="id" size=1>
            <option selected="false" disabled="disabled">--SELECCIONE UNA OPCIÓN--</option>
            @foreach($laboratorios as $laboratorio)
                <option value="{{$laboratorio->id}}">{{$laboratorio->Nombre}}</option>
                
            @endforeach
            </select>
          </div>
          <div class="col-3">
            <button class="btn btn-secondary my-2 my-sm-0 btn-block" type="submit">Buscar</button>
          </div>
          <div class="col-3">
            <a href="/agenda" class="btn btn-danger btn-block">Quitar Busqueda</a>
          </div>
          
          </form>
        @endif
      <br>
      </ul>



        <div id='calendar'></div>
        </div>
        <div class="col"></div>
  </div>

  <body>
  <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      launch demo Modal </button> !-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Datos de la reserva</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="false">&times;</span>
              <button>
      </div>
      <div class="modal-body">
        ID:
        <input type="text" name="txtID" id="txtID"readonly>
        <br/>
        Motivo:
        <input type="text" name="txtTMotivo" id="txtTMotivo" readonly>
        <br/>
        Fecha:
        <input type="text" name="txtFecha" id="txtFecha"readonly>
        <br/>
        Bloques:
        <input type="text" name="txtmodulos" id="txtmodulos"readonly>
        <br/>
        Usuario id:
        <input type="text" name="txtUsuario_id" id="txtUsuario_id"readonly>
        <br/>
        Laboratorio id:
        <input type="text" name="txtlaboratorio_id" id="txtlaboratorio_id"readonly>
        <br/>
        Reserva id:
        <input type="text" name="txtReserva_id" id="txtReserva_id"readonly>
        <br/>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
        </div>
      </div>
  </body>


</html>
@endsection
