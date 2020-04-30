@extends('layouts.template')

@section('title')
Calendario
@endsection

@section('body')
Esto sera el Calendario del Empleado
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid' ]
        });

        calendar.render();
      });
</script>
<div id='calendar'></div>
@endsection