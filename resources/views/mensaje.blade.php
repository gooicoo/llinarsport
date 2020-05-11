@extends('layouts.template')

@section('title')
  Chat
@endsection

@section('body')
<div class="container2 clearfix">
    <div class="people-list" id="people-list">
        <div class="search">
            <input class="input-chat" type="text" placeholder="Buscar" />
            <i class="fa fa-search"></i>
        </div>
        <ul class="ul-chat-nombres"  class="list">
             @foreach($users as $user)
             @if(Auth::user()->id != $user->id)
             
             <li onclick="printar_mensaje({{$user->id}},{{Auth::user()->id}})" class="li-chat-nombres clearfix open_chat">
                <input type="text" name="fk_users_remitente" value="{{$user->id}}" hidden>
                <i class="img-chat fa fa-user-circle-o" aria-hidden="true"></i>
                <div class="about">
                    <div class="name">{{$user->name}}</div>
                    <div class="status">
                        <i class="fa fa-building"></i>  {{$user->instalacion->nombre}}
                    </div>
                </div>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    
    <div class="chat">
        <div class="chat-header clearfix">
        <i class="img-chat fa fa-user-circle-o" aria-hidden="true"></i>
            <div class="chat-about">
                <div nameclass="chat-with">Ningun chat abierto</div>
                <!-- <div class="chat-num-messages">already 1 902 messages</div> -->
            </div>
            <i id="exit" class="fa fa-times" disabled></i>
        </div> <!-- end chat-header -->
        <div class="chat-history">
            <ul class="ul-chat" >
            </ul>
        </div> <!-- end chat-history -->
        <div class="chat-message clearfix">
            
            <input type="text" name="fk_user_auth" value="{{Auth::user()->id}}" hidden>
            <textarea class="textarea-chat" name="mensaje" id="message-to-send" placeholder ="Type your message" rows="3" onkeypress="pulsar(event)" disabled></textarea>  
            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
            <i class="fa fa-file-image-o"></i>
            
            <button class="button-chat" onclick="Enviar()"disabled>Send</button>

        </div> <!-- end chat-message -->
    </div> <!-- end chat -->
</div> <!-- end container -->
@endsection