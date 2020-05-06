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
             <li class="li-chat-nombres clearfix open_chat">
                <i class="img-chat fa fa-user-circle-o" aria-hidden="true"></i>
                <div class="about">
                    <div class="name">{{$user->name}}</div>
                    <div class="status">
                        <i class="fa fa-building"></i>  {{$user->instalacion->nombre}}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    
    <div class="chat">
        <div class="chat-header clearfix">
        <i class="img-chat fa fa-user-circle-o" aria-hidden="true"></i>
            <div class="chat-about">
                <div class="chat-with">Ningun chat abierto</div>
                <!-- <div class="chat-num-messages">already 1 902 messages</div> -->
            </div>
            <i id="exit" class="fa fa-times"  disabled></i>
        </div> <!-- end chat-header -->
        <div class="chat-history">
            <ul class="ul-chat" >
                 <!-- <li class="li-chat clearfix">
                    <div class="message-data align-right">
                        <span class="message-data-time" >10:10 AM, Today</span> &nbsp; &nbsp;
                        <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
                    </div>
                    <div class="message other-message float-right">
                        Hi Vincent, how are you? How is the project coming along?
                    </div>
                </li>
                 <li class="li-chat" >
                    <div class="message-data">
                        <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                        <span class="message-data-time">10:12 AM, Today</span>
                    </div>
                    <div class="message my-message">
                        Are we meeting today? Project has been already finished and I have resul class="ul-chat" ts to show you.
                    </div>
                </li> -->
            </ul>
        </div> <!-- end chat-history -->
        <div class="chat-message clearfix">
            <textarea class="textarea-chat" name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3" disabled></textarea>
                    
            <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
            <i class="fa fa-file-image-o"></i>
            
            <button class="button-chat" disabled>Send</button>

        </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
    
</div> <!-- end container -->

<script id="message-template" type="text/x-handlebars-template">
   <li class="clearfix li-chat">
    <div class="message-data align-right">
      <span class="message-data-time" >, Today</span> &nbsp; &nbsp;
      <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
    </div>
    <div class="message other-message float-right">
      
    </div>
  </li>
</script>

<script id="message-response-template" type="text/x-handlebars-template">
   <li class="li-chat">
    <div class="message-data">
      <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
      <span class="message-data-time">, Today</span>
    </div>
    <div class="message my-message">
    </div>
  </li>
</script>

@endsection