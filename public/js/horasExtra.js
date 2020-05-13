
$(document).ready(function(){
      var fecha = new Date();
      var primerDia = new Date(fecha.getFullYear(), fecha.getMonth(), 1);
      var ultimoDia = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 0);

      var primerDia = (primerDia.getFullYear())+ '-' +("0" + (primerDia.getMonth()+1)).slice(-2)+ '-' +("0" + primerDia.getDate()).slice(-2);
      $("input[name='buscarFechaInicio']").val(primerDia);
      console.log(primerDia)

      var ultimoDia = (ultimoDia.getFullYear())+ '-' +("0" + (ultimoDia.getMonth()+1)).slice(-2)+ '-' +("0" + ultimoDia.getDate()).slice(-2);
      $("input[name='buscarFechaFin']").val(ultimoDia);
      console.log(ultimoDia)
});



function VerificarHoraExtra(){
        var data = {
            estado: $('input[name="estado"]').val(),
            "_token": $("meta[name='csrf-token']").attr("content"),
            "_method": 'POST'
        };

        $.ajax({
            url     : "/horasExtras/update",
            type    : 'POST',
            data    : data,
            dataType: 'json',
            success : function(success){
                console.log(success)
            },
            error : function(error){
                console.log(error)
            }
        });
    }
