
<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title', 'Default') | LlinarSport</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <script src="https://use.fontawesome.com/3e80329e87.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('js/comunicados.js') }}"></script>
    <script src="{{ asset('js/horasExtra.js') }}"></script>
    <script src="{{ asset('js/muro.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{ asset('chat/chat.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/footer.css')}}">
    <link rel="stylesheet" href="{{ asset('css/menu.css')}}">
    <link rel="stylesheet" href="{{ asset('css/contenido.css')}}">
    <link rel="stylesheet" href="{{ asset('css/chat.css')}}">
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{ asset('css/muro.css')}}">
    <link rel="stylesheet" href="{{ asset('css/alertas.css')}}">
    <link rel="stylesheet" href="{{ asset('css/horasExtra.css')}}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/core/main.css')}}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/daygrid/main.css')}}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/list/main.css')}}">
    <link rel="stylesheet" href="{{ asset('fullcalendar/timegrid/main.css')}}">
</head>
<body>
    @include('layouts.app')

    <section class="contenido">
        @yield('body')
    </section>
    @include('layouts.footer')

</body>

</html>
