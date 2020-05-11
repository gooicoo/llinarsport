$(document).ready(function(){

    

    $(".open_chat").click(function(){
        // $('.chat-history').scrollBottom($('.chat-history').height());
        var nombre_emp_chat = $(this).find(".name").text();
        var id_users_remitente =  $(this).find("input[name='fk_users_remitente']").val();
        var info_chat_header = $("<i class='img-chat fa fa-user-circle-o' aria-hidden='true'></i><div class='chat-about'><div class='chat-with'><div></div></div></div><i id='exit' class='fa fa-times'></i>");
        var div_nombre_emp = $("<div class='nombre_emp'>"+nombre_emp_chat+"</div>")
        $(".chat-header").empty();
        $(".chat-header").append(info_chat_header).find(".chat-with").append(div_nombre_emp);
        $(".textarea-chat").removeAttr("disabled");
        $("input[name='fk_user_remitente']").remove();
        $(".chat-message").append($("<input name='fk_user_remitente' type='text' value="+id_users_remitente+" hidden></input>"))
    });

    $('.textarea-chat').keypress(function () {
        if (!$.trim($(".textarea-chat").val()) == false) {
            // textarea is empty or contains only white-space
            $(".button-chat").removeAttr("disabled");
        }
    });
});

function pulsar(e){
    if (!$.trim($(".textarea-chat").val()) == false) {
        // textarea is empty or contains only white-space
        $(".button-chat").removeAttr("disabled");
        if (e.keyCode === 13 ) {
            Enviar();
        }
    }
}

function Enviar(){
    var today = new Date();
    var time = ("0" + today.getHours()).slice(-2) + ":" + ("0" + today.getMinutes()).slice(-2) + ":" + ("0" + today.getSeconds()).slice(-2);
    var date = today.getFullYear()+'-'+("0" + (today.getMonth()+1)).slice(-2)+'-'+("0" + today.getDate()).slice(-2);
    var dateTime = date +" "+ time;
    // $('.chat-history').animate({
    //     scrollTop: $('.chat-history').get(0).scrollHeight
    // }, 2000);
    $(".button-chat").prop("disabled", true);
    
    var data = {
        mensaje: $('textarea[name="mensaje"]').val(),
        fk_users_id: $('input[name="fk_user_auth"]').val(),
        fk_users_id_remitente: $("input[name='fk_user_remitente']").val(),
        fecha: dateTime,
        "_token": $("meta[name='csrf-token']").attr("content"),
        "_method": 'POST'
    };
    ejecutarAjax(data);
}

function ejecutarAjax(data){
    $.ajax({
        type: 'POST',
        url: '/mensaje',
        data: data,
        dataType: "json",
        success: function(success){
            console.log(success);
        },
        error: function(error){
            console.log(error);
        }
    })
    $('.textarea-chat').val("");
}

function limpiar_chat(){
    $(".ul-chat").empty();
}

function printar_mensaje(id_usuario_remitente, id_usuario_auth){
    clearInterval(stop);
    stop = setInterval(function(){
        $.getJSON("/api/mensajes", function(datos){
            datos.reverse();
            limpiar_chat();
            for(var i=0; i<datos.length;i++){
                if(id_usuario_remitente == JSON.stringify(datos[i].fk_users_id_remitente) || id_usuario_auth == JSON.stringify(datos[i].fk_users_id_remitente)){
                    if(id_usuario_auth == JSON.stringify(datos[i].fk_users_id)){
                        var user_auth = $("#navbarDropdown").text();
                        var mensaje = JSON.stringify(datos[i].mensaje);
                        var fecha = JSON.stringify(datos[i].fecha);
                        var div_msg_data = $("<div class='message-data align-right'><span class='message-data-time'>"+fecha+"</span>&nbsp; &nbsp;<span class='message-data-name'>"+user_auth+"</span></div>");
                        var div_msg_text = $("<div class='message my-message float-right'></div>").text(mensaje);
                        var li = $("<li id=id_"+i+" class='li-chat clearfix'></li>").append(div_msg_data).append(div_msg_text);
                        $(".ul-chat").append(li);
                    }else if(id_usuario_remitente == JSON.stringify(datos[i].fk_users_id) && id_usuario_auth == JSON.stringify(datos[i].fk_users_id_remitente)){
                        var user_remitente = $(".nombre_emp").text();
                        var mensaje = JSON.stringify(datos[i].mensaje);
                        var fecha = JSON.stringify(datos[i].fecha);
                        var div_msg_data = $("<div class='message-data align-left'><span class='message-data-time out'>"+fecha+"</span>&nbsp; &nbsp;<span class='message-data-name out'>"+user_remitente+"</span></div>");
                        var div_msg_text = $("<div class='message other-message float-left'></div>").text(mensaje);
                        var li = $("<li id=id_"+i+" class='li-chat clearfix'></li>").append(div_msg_data).append(div_msg_text);
                        $(".ul-chat").append(li);
                    }
                }
                
            }
        });
    }, 1000 );
}