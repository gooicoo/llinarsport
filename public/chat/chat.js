$(document).ready(function(){

    $(".open_chat").click(function(){
        var nombre_emp_chat = $(this).find(".name").text();
        $(".ul-chat").empty();
        var info_chat_header = $("<i class='img-chat fa fa-user-circle-o' aria-hidden='true'></i><div class='chat-about'><div class='chat-with'>Ningun chat abierto</div><!-- <div class='chat-num-messages'>already 1 902 messages</div> --></div><i id='exit' class='fa fa-times'></i>");
        $(".chat-header").empty();
        $(".chat-header").append(info_chat_header).find(".chat-with").text("Chat con "+nombre_emp_chat+"");
        $(".textarea-chat").removeAttr("disabled");
        
        //$("#exit").removeAttr("disabled");
    });

    $('.textarea-chat').keypress(function () {
        if (!$.trim($(".textarea-chat").val()) == false) {
            // textarea is empty or contains only white-space
            $(".button-chat").removeAttr("disabled");
        }
    });
    function enviar_mensaje(){

    }

    function recivir_mensaje(){

    }
    var id = 1;
    $(".button-chat").click(function(){
        var mi_mensaje =  $('.textarea-chat').val();
        var mensaje_completo = $("<li id="+id+" class='li-chat clearfix'><div class='message-data align-right'><span class='message-data-time'>10:10 AM, Today</span> &nbsp; &nbsp;<span class='message-data-name'></span> <i class='fa fa-circle me'></i></div><div class='message my-message float-right'></div></li>");
        $(".ul-chat").append(mensaje_completo);
        $("#"+id+"").find(".my-message").text(mi_mensaje);
        id++;
        $('.chat-history').animate({
            scrollTop: $('.chat-history').get(0).scrollHeight
        }, 200);
        $(".button-chat").prop("disabled", true);
        $('.textarea-chat').val("");
    });

    $("#exit").click(function(){
        
    });
    
});
