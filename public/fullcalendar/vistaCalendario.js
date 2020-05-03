document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid' , 'interaction' , 'timeGrid' , 'list'],

      header:{
        left:'prev,next today Miboton',
        center:'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
      },

      events:[{
        title: "Spinnig",
        start:"2020-05-05 12:00:00",
        end:"2020-05-05 13:00:00",
        descripcion:"Bici",
        },
      ],

      dateClick:function(info){
        $('#dia').val(info.dateStr);
        $('#añadirEvento').modal();
      },





    });

    calendar.setOption('locale','Es');
    calendar.render();

    $('#btnAgregar').click(function(){
      añadirEvento("GET");
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
