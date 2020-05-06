<nav class="menu navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/muro') }}">MURO <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/horasExtras') }}">CONTROLADOR DE HORAS EXTRA</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/comunicados') }}">CONTROLADOR DE COMUNICADOS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/calendario') }}">HORARIO | CUADRANTE</a>
      </li>
      @if (Auth::user()->fk_role_id == 3)
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/gestionEmpleados') }}">GESTIÓN DE EMPLEADOS</a>
          </li>
      @elseif (Auth::user()->fk_role_id == 2)
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/gestionEmpleados') }}">GESTIÓN DE EMPLEADOS</a>
          </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/mensaje') }}">CHAT</a>
      </li>
    </ul>
  </div>
</nav>
