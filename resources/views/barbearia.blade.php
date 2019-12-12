<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$barbearia->nome}}</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('css/errmsg.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>


  <!-- Custom styles for this template -->
  <link href="css/agency.min.css" rel="stylesheet">

</head>


<body id="page-top" @error('email') onload="$('#modalLogin').modal()" @enderror>
@include('mensagens.validacoes')
@include('mensagens.login')


<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
<div class="container">
  <a class="navbar-brand js-scroll-trigger" href="#page-top">{{$barbearia->nome}}</a>

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
              <a class="nav-link" href="/">{{ __('Principal WebSalão') }}</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/pesquisar/{{ $barbearia->cidade_id }}">Estabelecimentos em {{ $barbearia->cidade->nome }}</a>
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
                  <a class="dropdown-item" href="/pesquisar/{{ $barbearia->cidade_id }}">Estabelecimentos em {{ $barbearia->cidade->nome }}</a>
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


  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
      <div class="intro-lead-in">Seja bem vindo, voce está em {{ $barbearia->nome }} </div>
        <div class="intro-heading text-uppercase">É um prazer recebe-lo!</div>

        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
          Agendamento
        </button>
      </div>
    </div>
  </header>

<div class="container">
  <div class="col-md-12" align="center">
  <h1>Produtos</h1>
  </div>
<div class="row">

@foreach($produtos as $p)
  <div class="col-md-4">
    <div class="card mb-4 shadow-sm">
    <img class="card-img-top" src="{{ asset('imagens/'.$p->foto) }}" height="200px" alt="Imagem de capa do card">
    <div class="card-body">
      <h5 class="card-title">{{$p->nome}}</h5>
      <p class="btn btn-dark">R${{$p->valor}}</p>
    </div>
    </div>
  </div>
@endforeach
</div>
{{ $produtos->links() }}
</div>



  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <span class="copyright">Copyright &copy; WebSalão 2019</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
                @if (Route::has('login'))
                    @auth
                      <li class="list-inline-item">
                        <a href="{{ url('/painel/home') }}">Painel</a>
                      </li>
                    @else
                      <li class="list-inline-item">
                        <a  href="" data-toggle="modal" data-target="#modalLogin">Entrar</a> -
                      </li>
                        @if (Route::has('register'))
                         <li class="list-inline-item">
                            <a href="{{ route('register') }}">Registrar</a>
                          </li>
                        @endif
                    @endauth
                @endif
          </ul>
        </div>
      </div>
    </div>
  </footer>






<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- Modal Agendamento-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" >
@if(Auth::user())
@if(Auth::user()->tipo == 'cliente')
      <div class="modal-body">
        <div class="row  justify-content-md-center">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-corte" role="tab" aria-controls="pills-home" aria-selected="true">Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-barbeiro" role="tab" aria-controls="pills-profile" aria-selected="false">Profissional</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-dia" role="tab" aria-controls="pills-contact" aria-selected="false">Dia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-hora" role="tab" aria-controls="pills-contact" aria-selected="false">Hora</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-confirmacao" role="tab" aria-controls="pills-contact" aria-selected="false">Confirmação</a>
          </li>
          </ul>
        </div>



      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-corte" role="tabpanel" aria-labelledby="pills-corte-tab">
          <div class="row  justify-content-md-center">
              @foreach($barbearia->cortes as $c)
                <div class="col-md-5 shadow p-3 mb-5 bg-white"  align="center" style="margin: 10px;">
                  <a href="#"  onclick="proxima(2); preencher('{{$c->nome}}', 'corte', '{{$c->id}}');"><img src="{{ asset('imagens/'.$c->foto) }}" style="max-width: 100%" ></a>
                  <h5 class="card-text">{{$c->nome}} </h5>
                  <h6 class="card-text">R${{$c->valor}} </h6>
                </div>
              @endforeach

          </div>
        </div>
        <div class="tab-pane fade" id="pills-barbeiro" role="tabpanel" aria-labelledby="pills-barbeiro-tab">
          <div class="row  justify-content-md-center">
            @foreach($barbearia->barbeiros as $b)
              <div class="col-md-5 shadow p-3 mb-5 bg-white"  align="center" style="margin: 10px;">
                  <a href="#"  onclick="proxima(3); preencher('{{$b->nome}}', 'barbeiro', '{{$b->id}}');"><img src="{{ asset('imagens/'.$b->foto) }}" style="max-width: 100%" class="rounded"></a>
                  <h5 class="card-text">{{$b->nome}} </h5>
              </div>
            @endforeach

          </div>
        </div>
        <div class="tab-pane fade" id="pills-dia" role="tabpanel" aria-labelledby="pills-dia-tab" align="center">
          <input class="form-control" type="date" id="inputData" name="" min="{{date('Y-m-d')}}" >
          <h4>Abertos de {{date('H:i', strtotime($barbearia->abre))}} às {{date('H:i', strtotime($barbearia->fecha))}}</h4>
          <br>
          <table class="table table-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Dia</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tr>
              <td>Domingo</td>
              <td class="{{in_array('0' , $barbearia->semana) ? 'text-success': 'text-danger'}}">{{in_array('0' , $barbearia->semana) ? 'Aberto': 'Fechado'}}</td>
            </tr>
            <tr>
              <td>Segunda</td>
              <td class="{{in_array('1' , $barbearia->semana) ? 'text-success': 'text-danger'}}">{{in_array('1' , $barbearia->semana) ? 'Aberto': 'Fechado'}}</td>
            </tr>
            <tr>
              <td>Terça</td>
              <td class="{{in_array('2' , $barbearia->semana) ? 'text-success': 'text-danger'}}">{{in_array('2' , $barbearia->semana) ? 'Aberto': 'Fechado'}}</td>
            </tr>
            <tr>
              <td>Quarta</td>
              <td class="{{in_array('3' , $barbearia->semana) ? 'text-success': 'text-danger'}}">{{in_array('3' , $barbearia->semana) ? 'Aberto': 'Fechado'}}</td>
            </tr>
            <tr>
              <td>Quinta</td>
              <td class="{{in_array('4' , $barbearia->semana) ? 'text-success': 'text-danger'}}">{{in_array('4' , $barbearia->semana) ? 'Aberto': 'Fechado'}}</td>
            </tr>
            <tr>
              <td>Sexta</td>
              <td class="{{in_array('5' , $barbearia->semana) ? 'text-success': 'text-danger'}}">{{in_array('5' , $barbearia->semana) ? 'Aberto': 'Fechado'}}</td>
            </tr>
            <tr>
              <td>Sábado</td>
              <td class="{{in_array('6' , $barbearia->semana) ? 'text-success': 'text-danger'}}">{{in_array('6' , $barbearia->semana) ? 'Aberto': 'Fechado'}}</td>
            </tr>
          </table>

        </div>
        <div class="tab-pane fade" id="pills-hora" role="tabpanel" aria-labelledby="pills-hora-tab">
          <div class="row" id="tblHorarios" align="center">

          </div>
        </div>
        <div class="tab-pane fade" id="pills-confirmacao" role="tabpanel" aria-labelledby="pills-confirmacao-tab">
          <form id="formAgendamento" method="post" action="/cadastrar/agendamento">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="barbearia_id" value="{{$barbearia->id}}">
          <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="corte" readonly>
            <input type="hidden" class="form-control" id="corteid" name="corte_id" readonly>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button"  onclick="proxima(1)">Editar</button>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" readonly id="barbeiro">
            <input type="hidden" class="form-control" id="barbeiroid" name="barbeiro_id" readonly>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" onclick="proxima(2)">Editar</button>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="hidden" class="form-control" readonly id="datax" name="data">
            <input type="text" class="form-control" readonly id="data">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" onclick="proxima(3)">Editar</button>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" readonly id="hora" name="hora">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" onclick="proxima(4)">Editar</button>
            </div>
          </div>

          <button class="btn btn-success " type="submit" style="float: right;">Agendar!</button>
          </form>


        </div>
      </div>
      </div>

@else
  <div class="modal-body bg-warning" align="center">
    <strong>Atenção!</strong> Nao é possível realizar agendamentos com sua conta do tipo barbearia!
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Sair
    </a>
  </div>
@endif
@else
  <div class="modal-body bg-danger" align="center" >
    <strong>Erro!</strong> Faça  <a class="nav-link" href="" data-toggle="modal" data-target="#modalLogin" style="color: #000;">Login</a> para realizar o agendamento!
  </div>
@endif
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


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/agency.min.js"></script>




<script type="text/javascript">
const picker = document.getElementById('inputData');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  if(![{{implode(",", $barbearia->semana)}}].includes(day)){
    e.preventDefault();
    this.value = '';
    return alert('Barbearia não abre no dia escolhido!');
    exit;
  }else{
      proxima(4);
      preencher('data', 'data');
      seleciona();


  }
});
</script>


<script type="text/javascript">

function proxima(id){
  $('#pills-tab li:nth-child('+id+') a').tab('show') // Por ID
}

function preencher(nome,campo, id){
  if(nome == 'data'){
    $("#tblHorarios tbody tr").append("");
    var date = new Date($('#inputData').val());
    day = date.getDate() +1;
    month = date.getMonth() + 1;
    year = date.getFullYear();
    $("#"+campo).val([day, month, year].join('-'));
    $("#"+campo+'x').val([year, month, day].join('-'));
  }else if(campo == 'barbeiro'){
    $("#inputData").val("");
    $("#tblHorarios tbody tr").html("");
    $("#"+campo).val(nome);
    $("#"+campo+'id').val(id);
  }else{
    $("#"+campo).val(nome);
    $("#"+campo+'id').val(id);
  }
}


function seleciona(){
  barbeiro_id = $('#barbeiroid').val();
  data = $('#datax').val();
  var horarios =  {{$barbearia->horarios()}};
  horarios = horarios.map(x => {
    if(x<10) return '0'+x.toString() + ':00'
    else return x.toString() + ':00';
  })
  console.log(horarios);
  $.ajax({
        url: '/painel/cliente/agendamentos/' + barbeiro_id + '/' + data,
        type: 'get',
        success: function(response){
          var datanow = new Date();
          var str_data = datanow.getFullYear() + '-' + (datanow.getMonth()+1) + '-' + datanow.getDate();
          var agendamentos =JSON.parse(response)
          var horariosMarcado = [];
          agendamentos.forEach((item) =>{
            horariosMarcado.push(item.hora);
          });
          $("#tblHorarios").html("");

          horarios.forEach((item) => {
            if($.inArray(item, horariosMarcado) == -1){
              if(data == str_data){
                if(item.substring(0,2) > datanow.getHours())
                $("#tblHorarios").append("<div class=\"col-sm-2 shadow p-3 mb-5 bg-white\" style=\"margin:5px\"><a  href=\"#\" onclick=\"proxima(5); preencher('"+item+"', 'hora');\">"+item+"</a></div>");
              }else{
                $("#tblHorarios").append("<div class=\"col-sm-2 shadow p-3 mb-5 bg-white\" style=\"margin:5px\"><a  href=\"#\" onclick=\"proxima(5); preencher('"+item+"', 'hora');\">"+item+"</a></div>");
              }
            }
          })

          console.log(data);
          console.log(str_data);
           console.log(horariosMarcado);
           console.log(horarios);

        }
      });

  }
</script>


</body>

</html>
