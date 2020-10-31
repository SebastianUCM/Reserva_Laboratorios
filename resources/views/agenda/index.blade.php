
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
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'es',
                events: {!! json_encode($datos_Eventos) !!}
            });
            calendar.render();
        });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>
@endsection
