<li @if(request()->is('muro')) class="nav-item active" @endif>
  <a class="nav-link" href="{{ url('/muro') }}">MURO</a>
</li>
<li @if(request()->is('horasExtras')) class="nav-item active" @endif>
  <a class="nav-link" href="{{ url('/horasExtras') }}">HORAS EXTRA</a>
</li>
<li @if(request()->is('comunicados')) class="nav-item active" @endif>
  <a class="nav-link" href="{{ url('/comunicados') }}">COMUNICADOS</a>
</li>
@if (Auth::user()->fk_role_id != 4)
<li @if(request()->is('calendario')) class="nav-item" active @endif>
  <a class="nav-link" href="{{ url('/calendario') }}">HORARIO</a>
</li>
@endif
@if (Auth::user()->fk_role_id == 3)
    <li @if(request()->is('gestionEmpleados')) class="nav-item active" @endif>
      <a class="nav-link" href="{{ url('/gestionEmpleados') }}">EMPLEADOS</a>
    </li>
    @elseif (Auth::user()->fk_role_id == 2)
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/gestionEmpleados') }}">EMPLEADOS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/gestionActividades') }}">ACTIVIDADES</a>
      </li>
      @endif
<li @if(request()->is('mensaje')) class="nav-item active" @endif>
  <a class="nav-link" href="{{ url('/mensaje') }}">MENSAJES</a>
</li>
