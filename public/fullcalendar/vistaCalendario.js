document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid' , 'interaction' , 'timeGrid' , 'list'],

      header:{
        left:'prev,next today Miboton',
        center:'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
      },

      events:[
        {
          title:'Spinnig',
          description:"bici",
          start:"2020-05-05 12:00:00",
          end:"2020-05-05 13:00:00"
        },
        "{{ url('/calendario/show') }}"
      ],

      dateClick:function(info){
        $('#añadirEvento').modal('toggle');
        console.log(info);
        calendar.addEvent({ title: 'Evento X', date:info.dateStr });
        $('#dia').val(info.dateStr);
      },
      eventClick:function(info){
        console.log(info);
        console.log(info.event.title);
        console.log(info.event.start);
        console.log(info.event.extendedProps.description);
      }
    });

    calendar.setOption('locale','Es');
    calendar.render();

    $('#btnAgregar').click(function(){
        objEvento = recolectarDatosGUI('POST');
        enviarInfo('',objEvento);
    });

    function recolectarDatosGUI(method){
        nuevoEvento={
          id:$('#id').val(),
          title:$('#titulo').val(),
          description:$('#descripcion').val(),
          start:$('#dia').val()+" "+$('#inicio').val(),
          end:$('#dia').val()+" "+$('#fin').val(),
          '_token':$("meta[name='csrf-token']").attr("content"),
          '_method':method
        }
        // console.log(nuevoEvento);
        return (nuevoEvento);
    }

    function enviarInfo(acction,objEvento){
        $.ajax(
          {
            type:"POST",
            url:"/calendario/"+acction,
            data:objEvento,
            success:function(msg){console.log(msg);},
            error:function(){alert("Hay un error");}
          }
        );
    }


});
