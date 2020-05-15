$(document).ready(function(){

    $('#informacion_boton').hover(
      function() {
          $('#informacion_boton').attr('hidden',true);
          $('#informacion_estados').removeAttr('hidden');
      },
      function() {
          $('#informacion_boton').removeAttr('hidden');
          $('#informacion_estados').attr('hidden',true);
      }
    );

});
