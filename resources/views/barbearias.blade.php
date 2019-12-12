<!DOCTYPE html>
<!-- saved from url=(0053)https://getbootstrap.com.br/docs/4.1/examples/album/# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>{{$cidade->nome}}</title>

    <!-- Principal CSS do Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Estilos customizados para este template -->
    <link href="{{asset('css/album.css')}}" rel="stylesheet">
  </head>

<body @error('email') onload="$('#modalLogin').modal()" @enderror>

@if(isset($_GET['login']))
<div id="message" class="errmsg">
        <div class="alert alert-success alert-success"  class="errmsgdiv" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            Login efetuado com sucesso!<b> Acesse seu <a href="{{ url('/painel/home') }}">painel</a>.</b>
        </div>
    </div>
@endif
@error('email')
    <div id="message"  class="errmsg">
        <div class="alert alert-danger alert-dismissable" class="errmsgdiv">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            Login ou senha incorreta!
        </div>
    </div>
@enderror




<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
<div class="container">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
  <span class="navbar-toggler-icon"></span>
  </button>

 <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <!-- Left Side Of Navbar -->
  <ul class="navbar-nav mr-auto">

  </ul>

  <!-- Right Side Of Navbar -->
  <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
          <li class="nav-item">
              <a class="nav-link" href="/">{{ __('Principal') }}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="" data-toggle="modal" data-target="#modalLogin">{{ __('Entrar') }}</a>
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
              </li>
          @endif
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('/painel/home') }}">Painel</a>
                  <a class="dropdown-item" href="/">
                      {{ __('Principal') }}
                  </a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
  </ul>
  </div>
</div>
</nav>






<main role="main">

<section>
<div class="container">
<div class="shadow-lg p-3 mb-5" align="center"  style="background: url('/img/bg-auto.png')">
  <img src="{{ asset('img/logo-3.png') }}" >
</div>
<div class="shadow-lg p-3 mb-5 bg-white text-center" >
  <h3>Barbearias do WebSalão para a cidade de {{$cidade->nome}}</h3>
</div>
</div>
</section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            @foreach($cidade->barbearias as $b)

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="{{ asset('imagens/'.$b->foto) }}" height="300px" data-holder-rendered="true">
                <div class="card-body">
                  <h5 class="card-title"><a href="/{{$b->nome}}" style="color: #000">{{$b->nome}}</a></h5>
                  <strong class="card-title"><a href="/{{$b->nome}}" style="color: #000">{{$b->endereco}}</a></strong>
                  <div class="d-flex justify-content-between align-items-center">
                      <a href="/{{$b->nome}}" class="btn btn-outline-dark">Visitar</a>

                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
        </p>
      </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <form id="login" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Lembrar-me') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                    </form>
          </div>
          <div class="modal-footer">


            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" form="login">{{ __('Login') }}</button>
          </div>
        </div>
      </div>
    </div>





    <script src="{{asset('css/jquery-3.3.1.slim.min.js.download')}}" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="{{asset('css/popper.min.js.download')}}"></script>
    <script src="{{asset('css/bootstrap.min.js.download')}}"></script>
    <script src="{{asset('css/holder.min.js.download')}}"></script>


<svg xmlns="http://www.w3.org/2000/svg" width="348" height="225" viewBox="0 0 348 225" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="17" style="font-weight:bold;font-size:17pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thumbnail</text></svg></body></html>
