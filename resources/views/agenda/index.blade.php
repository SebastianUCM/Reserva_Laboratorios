
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
                locale: 'es',
                initialView: 'dayGridMonth',
                navLinks: true,
                selectable: true,
                selectMirror: true,
                select: function(arg) {
                    $("#agenda_modal").modal();
                    calendar.unselect()
                },

                eventClick: function(arg) {
                    if (confirm('Are you sure you want to delete this event?')) {
                    arg.event.remove()
                    }
                },
                editable: true,
            });
            calendar.render();
        })

        function guardar(){
            var fd = new FormData(document.getElementById("formulario_agenda"));
            let fecha = $("txtFecha").val();
            let hora_inicial = $("txtHoraInicial").val();
            let hora_final = $("txtHoraFinal").val();



            $.ajax({
                url:"/agenda/guardar",
                type: "POST",
                data: fd,
                processData: false,
                contentType: false
            });

        }

    </script>

  </head>
  <body> 
    <!-- Calendario -->
    <div class='col'>
        <div id='calendar'></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="agenda_modal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reservar Laboratorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 <form id="formulario_agenda">
                 @csrf
                    <div class="modal-body">
   
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Fecha</label>
                                    <input class="form-control" type="date" id="txtFecha" name="txtFecha">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Hora Inicial</label>
                                    <input class="form-control" type="time" id="txtHoraInicial" name="txtHoraInicial">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Hora Final</label>
                                    <input class="form-control" type="time" id="txtHoraFinal" name="txtHoraFinal">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <div class="form-group">
                                        <textarea  class="form-control" id="txtDescripcion" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
            </form>
            </div>

        </div>
    </div>
  </body>
</html>
@endsection
