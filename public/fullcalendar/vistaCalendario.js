document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendario = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' , 'interaction' , 'timeGrid' , 'list'],

        header:{
          left:'prev,next today Miboton',
          center:'title',
          right: 'dayGridMonth',
        },

        dateClick:function(info){
          limpiarFormulario();
          $('#dia').val(info.dateStr);
          $('#btnAgregar').prop('hidden',false);
          $('#btnEliminar').prop('hidden',true);
          $('#btnEditar').prop('hidden',true);

          $('#añadirEvento').modal('toggle');
          mostrarHoraActual();
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
          $('#inicio').val(horaStart+':'+minutoStart);
          $('#fin').val(horaEnd+':'+minutoEnd);
          $('#actividad').val(info.event.title);
          $('#empleado').val(info.event.classNames);
          $('#añadirEvento').modal('toggle');
        },

        events: "calendario/show",
    });

    calendario.setOption('locale','Es');
    calendario.render();

    $('#btnAgregar').click(function(){
        if (validaForm() == true) {
          objEvento = recolectarDatosGUI('POST');
          enviarInfo('',objEvento);
        }
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
          classNames:$('#empleado').val(),
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
                  console.log('Hay un error')
            }
          }
        );
    }

    function limpiarFormulario(){
        $('#id').val('');
        $('#dia').val('');
        $('#inicio').val('');
        $('#fin').val('');
        $('#empleado').val('');
        $('#actividad').val('');
        $("#smallInicio").text('');
    }

    function mostrarHoraActual(){
        var today = new Date();
        var todayTime = ("0" + today.getHours()).slice(-2) + ":" + ("0" + today.getMinutes()).slice(-2);
        var todayTimePlus = ("0" + today.getHours()).slice(-2) + ":" + '01';
        // alert(todayTimePlus)
    }


    function validaForm(){
        if($("#inicio").val() == ""){
            $("#smallInicio").text("El campo hora inicio no puede estar vacío.").fadeOut(5000);
            return false;
        }
        if($("#fin").val() == ""){
            $("#smallFin").text("El campo hora fin no puede estar vacío.").fadeOut(5000);
            return false;
        }
        if ( $("#inicio").val() >= $("#fin").val() ) {
            $("#smallDiferencia").text("El campo hora inicio no puede ser mayor o igual que el de hora fin.").fadeOut(5000);
            return false;
        }
        if($("#actividad").val() == null){
            $("#smallActividad").text("El campo actividad no puede estar vacío.").fadeOut(5000);
            return false;
        }
        if($("#empleado").val() == null){
            $("#smallEmpleado").text("El campo empleado no puede estar vacío.").fadeOut(5000);
            return false;
        }

        return true;
    }

});
