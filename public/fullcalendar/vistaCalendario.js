document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendario = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' , 'interaction' , 'timeGrid' , 'list'],

        header:{
          left:'prev,next today Miboton',
          center:'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },

        dateClick:function(info){
          limpiarFormulario();
          $('#dia').val(info.dateStr);
          $('#btnAgregar').prop('hidden',false);
          $('#btnEliminar').prop('hidden',true);
          $('#btnEditar').prop('hidden',true);

          $('#añadirEvento').modal('toggle');
          // console.log(info);
        },

        eventClick:function(info){
          $('#btnAgregar').prop('hidden',true);
          $('#btnEliminar').prop('hidden',false);
          $('#btnEditar').prop('hidden',false);

          dia = (info.event.start.getDate());
          mes = (info.event.start.getMonth()+1);
          anio = (info.event.start.getFullYear());
          horaStart = (info.event.start.getHours());
          minutoStart = (info.event.start.getMinutes());
          horaEnd = (info.event.end.getHours());
          minutoEnd = (info.event.end.getMinutes());

          // condicionales para hagregar un '0' si el dia/mes es inferior a 10
          mes = (mes<10)?'0'+mes:mes;
          dia = (dia<10)?'0'+dia:dia;
          horaStart = (horaStart<10)?'0'+horaStart:horaStart;
          minutoStart = (minutoStart<10)?'0'+minutoStart:minutoStart;
          horaEnd = (horaEnd<10)?'0'+horaEnd:horaEnd;
          minutoEnd = (minutoEnd<10)?'0'+minutoEnd:minutoEnd;

          $('#id').val(info.event.id);
          $('#dia').val(anio+'-'+mes+'-'+dia);
          // $('#dia').val(dia+'-'+mes+'-'+anio);
          $('#inicio').val(horaStart+':'+minutoStart);
          $('#fin').val(horaEnd+':'+minutoEnd);
          $('#actividad').val(info.event.title);
          $('#user').val(info.event.user);
          $('#añadirEvento').modal('toggle');
        },

        events: "calendario/show",
    });

    calendario.setOption('locale','Es');
    calendario.render();

    $('#btnAgregar').click(function(){
        objEvento = recolectarDatosGUI('POST');
        enviarInfo('',objEvento);
    });
    $('#btnEliminar').click(function(){
        objEvento = recolectarDatosGUI('DELETE');
        enviarInfo( ''+$('#id').val() , objEvento );
    });
    $('#btnEditar').click(function(){
        objEvento = recolectarDatosGUI('PATCH');
        enviarInfo( ''+$('#id').val() , objEvento );
    });

    function recolectarDatosGUI(method){
        nuevoEvento={
          id:$('#id').val(),
          user:$('#user').val(),
          title:$('#actividad').val(),
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
            success:function(msg){
                  console.log(msg);
                  $('#añadirEvento').modal('toggle');
                  calendario.refetchEvents();
            },
            error:function(){
                  alert("Hay un error");
            }
          }
        );
    }

    function limpiarFormulario(){
        $('#id').val('');
        $('#dia').val('');
        $('#inicio').val('');
        $('#fin').val('');
        $('#user').val('');
        $('#actividad').val('');
    }


});
