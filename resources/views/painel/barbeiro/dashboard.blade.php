@extends('layouts.menu')

@section('categoria')
    

    <div class="shadow-sm p-3 mb-5 bg-white">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h3>Seja bem vindo ao painel administrativo!</h3><br>
        @if(Auth::user()->tipo == 'barbeiro')
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text bg-success" id="basic-addon1">Seu código de barbeiro é:</span>
          </div>
          <input class="form-control col-md-1" type="number" value="{{Auth::user()->id}}" readonly onclick="this.select()">

        </div>
        	@if(!Auth::user()->barbeiro)
          <div class="alert alert-danger col-md-3" role="alert">
            Você ainda não pertence a uma barbearia.
          </div>
        	@endif
        @endif

@if(Auth::user()->barbeiro->barbearia )
    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalExemplo">
      Novo agendamento
    </a>
@endif

</div>




@if(Auth::user()->barbeiro->barbearia )
<!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Agendamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
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
              @foreach(Auth::user()->barbeiro->barbearia->cortes as $c)
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
            @foreach(Auth::user()->barbeiro->barbearia->barbeiros as $b)
              <div class="col-md-5 shadow p-3 mb-5 bg-white"  align="center" style="margin: 10px;">
                  <a href="#"  onclick="proxima(3); preencher('{{$b->nome}}', 'barbeiro', '{{$b->id}}');"><img src="{{ asset('imagens/'.$b->foto) }}" style="max-width: 100%" class="rounded"></a>
                  <h5 class="card-text">{{$b->nome}} </h5>
              </div>
            @endforeach
        
          </div>
        </div>
        <div class="tab-pane fade" id="pills-dia" role="tabpanel" aria-labelledby="pills-dia-tab" align="center">
          <input class="form-control" type="date" id="inputData" name="" min="{{date('Y-m-d')}}" >
        </div>
        <div class="tab-pane fade" id="pills-hora" role="tabpanel" aria-labelledby="pills-hora-tab">
          <div class="row" id="tblHorarios" align="center">

          </div>
        </div>
        <div class="tab-pane fade" id="pills-confirmacao" role="tabpanel" aria-labelledby="pills-confirmacao-tab">
          <form id="formAgendamento" method="post" action="/painel/barbeiro/agendamentos">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="barbearia_id" value="{{Auth::user()->barbeiro->barbearia->id}}">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="nome" placeholder="Nome do Cliente">
          </div>  
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
    </div>
  </div>
</div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Contact form JavaScript -->
  <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
  <script src="{{asset('js/contact_me.js')}}"></script>

  <!-- Custom scripts for this template -->




<script type="text/javascript">
const picker = document.getElementById('inputData');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  if(![{{implode(",", Auth::user()->barbeiro->barbearia->semana)}}].includes(day)){
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
  var horarios =  {{Auth::user()->barbeiro->barbearia->horarios()}};
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

<!-- 
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Agendamentos</div>

                <div class="card-body">
                    {!! $chart->container() !!}
                    {!! $chart->script() !!}
                </div>
        </div>        
    </div>    
</div> -->
@endif
@endsection
