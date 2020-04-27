
<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title', 'Default') | LlinarSport</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/footer.css')}}">
    <link rel="stylesheet" href="{{ asset('css/menu.css')}}">
    <link rel="stylesheet" href="{{ asset('css/contenido.css')}}">
    <link rel="stylesheet" href="{{ asset('css/chat.css')}}">
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}">
</head>
<body>
    @include('layouts.app')
    @include('layouts.nav')
    <section class="contenido">
        @yield('body')
        @yield('chat')
    </section>

    @include('layouts.footer')

</body>
</html>
