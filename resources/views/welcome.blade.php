<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Web Salão</title>
        <script src="{{ asset('js/app.js')   }}"></script>
        <link  href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/errmsg.css')}}" rel="stylesheet">


        <!-- Styles -->
        <style>
            html, body {
                background-image: url('img/welcome-background.jpg') ;
                color: #black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }


            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;


                background-color: rgba(00,00,00,0.8);
            }

            .title {
                font-size: 84px;
                color: white;
            }

            .links > a {
                color: black;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
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
        <div class="alert alert-danger alert-dismissable" class="errmsgdiv" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            Login ou senha incorreta!
        </div>
    </div>
@enderror
        
        <div class="flex-center position-ref full-height">


            <div class=" content card">
                <div class="col-md-12" style="padding: 50px;">
                <div class="title m-b-md">
                    <img  class="img-fluid" src="{{asset('img/logo-3.png')}}">
                </div>

                <select class="form-control  form-control-lg col-md-12" id="exampleFormControlSelect1"  onchange="location = this.value">
                        <option>Selecione uma cidade</option>
                    @foreach($cidades as $c)
                        <option value="pesquisar/{{$c->id}}">{{$c->nome}}</option>
                    @endforeach
                </select>
                <div>
                <div  style="margin-top: 15px">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/painel/home') }}">Painel</a>
                    @else
                        <a href="" data-toggle="modal" data-target="#modalLogin">Entrar</a> -

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrar</a>
                        @endif
                    @endauth
                @endif
                </div>
                </div>
            </div>
            </div>
        </div>





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
    </body>
</html>

<script type="text/javascript" src="{{asset('js/mensagem.js')}}"></script>
