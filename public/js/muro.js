$(document).ready(function(){
     $('.btn-muro').attr('disabled','disabled');
     $('input[type="text"]').keypress(function(){
            if($(this).val() != ''){
               $(this).siblings('button').removeAttr('disabled');
            }
     });
});
