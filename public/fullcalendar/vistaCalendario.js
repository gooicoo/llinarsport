document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid' , 'interaction' , 'timeGrid' , 'list'],

      header:{
        left:'prev,next today Miboton',
        center:'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
      },

      dateClick:function(info){
        $('#dia').val(info.dateStr);
        $('#añadirEvento').modal();
      },





    });

    calendar.setOption('locale','Es');
    calendar.render();

    $('#btnAgregar').click(function(){
      añadirEvento('POST');
    })

    function añadirEvento(method){
      nuevoEvento={
        id:$('#id').val(),
        titulo:$('#titulo').val(),
        description:$('#descripcion').val(),
        inicio:$('#dia').val()+" "+$('#inicio').val(),
        fin:$('#dia').val()+" "+$('#fin').val(),
        '_token':$("meta[name='csrf-token']").attr('content'),
        '_method':method
      }
      console.log(nuevoEvento);
    }

  });
