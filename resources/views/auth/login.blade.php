<!DOCTYPE html>
<html lang="sp" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
  </head>
  <body>
    <div class="cont">
      <div class="demo">
        <div class="login">
          <div class="login__empresa"><h2>Llinarsport</h2></div>
          <div class="login__form">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="login__row">
                <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                  <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                </svg>
                <input id="email" type="email" class="login__input name  @error('email') is-invalid @enderror" placeholder="Correo" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="login__row">
                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                  <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                </svg>
                <input id="password" type="password" class="login__input pass  @error('password') is-invalid @enderror" placeholder="Clave" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus/>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <!-- <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="content-input" id="defaultUnchecked" name="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="defaultUnchecked">Recuerdame</label>
              </div> -->
              <button type="submit" class="login__submit">
                  {{ __('Entrar') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
