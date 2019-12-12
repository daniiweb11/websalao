@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Minha Barbearia</h3></div>

    <div class="shadow-sm p-3 mb-5 bg-white">
    	@if(!Auth::user()->barbearia)
    		<span>Você ainda não possui uma barbearia. Clique no botão abaixo para criar! </span> <br>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionar">Nova Barbearia</button>
		@elseif(Auth::user()->barbearia and Auth::user()->barbearia->ativacao == 0)
			
		    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
		      <h1 class="display-4">Escolha um plano</h1>
		      <p class="lead"></p>
		    </div>
		      <div class="card-deck mb-3 text-center">
		      	@foreach($planos as $p)
		        <div class="card mb-4 shadow-sm">
		          <div class="card-header">
		            <h4 class="my-0 font-weight-normal">{{$p->nome}}</h4>
		          </div>
		          <div class="card-body">
		            <h1 class="card-title pricing-card-title">R${{number_format($p->valor, 2,',', '')}} <small class="text-muted">/ mês</small></h1>
		            <ul class="list-unstyled mt-3 mb-4">
		            	<li>{{$p->duracao}} dias</li>
		              {{$p->descricao}}
		            </ul>
		            <button type="button" class="btn btn-lg btn-block btn-outline-primary"  data-toggle="modal" data-target="#modalPagamento{{$p->id}}">Contratar</button>
		          </div>
		        </div>
		        @endforeach
		      </div>
		@elseif(Auth::user()->barbearia and Auth::user()->barbearia->ativacao == 1) <!-- se a barbearia estiver ativada -->
			<table class="table text-left table-sm">
			  <thead>
			    <tr>
			      <th scope="col" width="200">#</th>
			      <th scope="col">
			      	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalExemplo">
					  Editar Dados
					</button>
				</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">Nome</th>
			      <td><a href="/{{Auth::user()->barbearia->nome}}">{{Auth::user()->barbearia->nome}}</a></td>
			    </tr>
			    <tr>
			      <th scope="row">Razão Social</th>
			      <td>{{Auth::user()->barbearia->razao}}</td>
			    </tr>
			    <tr>
			      <th scope="row">CNPJ</th>
			      <td>{{Auth::user()->barbearia->cnpj}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Inscricao Estadual</th>
			      <td>{{Auth::user()->barbearia->ie}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Telefone</th>
			      <td>{{Auth::user()->barbearia->telefone}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Celular</th>
			      <td>{{Auth::user()->barbearia->celular}}</td>
			    </tr>
			    <tr>
			      <th scope="row">E-mail</th>
			      <td>{{Auth::user()->barbearia->email}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Cep</th>
			      <td>{{Auth::user()->barbearia->cep}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Numero</th>
			      <td>{{Auth::user()->barbearia->numero}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Endereco</th>
			      <td>{{Auth::user()->barbearia->endereco}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Cidade</th>
			      <td>{{Auth::user()->barbearia->cidade->nome}}</td>
			    </tr>

			  </tbody>
			</table>


			
	<div class="shadow-sm p-3 mb-5 bg-white">
	<div class="row">		
		<div class="col-md-3 bg-light">
		<h1>Dias da Semana</h1>
		<!-- {{var_dump(Auth::user()->barbearia->semana)}} -->
		<form  method="post" action="{{url('painel/barbearia/loja/'. Auth::user()->barbearia->id)}}"  enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" >
			<input type="hidden" name="_method" value="PUT" >
			<input type="hidden" name="semana[]" value="null" >
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="0" id="defaultCheck0" name="semana[]"   {{in_array('0' , Auth::user()->barbearia->semana) ? 'checked': ''}}>
		  <label class="form-check-label" for="defaultCheck0">
		    Domingo
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="semana[]" {{in_array('1' , Auth::user()->barbearia->semana) ? 'checked': ''}}>
		  <label class="form-check-label" for="defaultCheck1">
		    Segunda
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="2" id="defaultCheck2" name="semana[]" {{in_array('2' , Auth::user()->barbearia->semana) ? 'checked': ''}}>
		  <label class="form-check-label" for="defaultCheck2">
		    Terça
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="3" id="defaultCheck3" name="semana[]" {{in_array('3' , Auth::user()->barbearia->semana) ? 'checked': ''}}>
		  <label class="form-check-label" for="defaultCheck3">
		    Quarta
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="4" id="defaultCheck4" name="semana[]" {{in_array('4' , Auth::user()->barbearia->semana) ? 'checked': ''}}>
		  <label class="form-check-label" for="defaultCheck4">
		    Quinta
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="5" id="defaultCheck5" name="semana[]" {{in_array('5' , Auth::user()->barbearia->semana) ? 'checked': ''}}>
		  <label class="form-check-label" for="defaultCheck5">
		    Sexta
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="6" id="defaultCheck6" name="semana[]" {{in_array('6', Auth::user()->barbearia->semana) ? 'checked': ''}}>
		  <label class="form-check-label" for="defaultCheck6">
		    Sábado
		  </label>
		</div>
		<br>
		<button type="submit" class="btn btn-primary">Salvar</button>
		</form>
		</div>


		<div class="col-md-3 bg-light">
		<form  method="post" action="{{url('painel/barbearia/loja/'. Auth::user()->barbearia->id)}}"  enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" >
			<input type="hidden" name="_method" value="PUT" >
		<h1>Horários</h1>
		<div class="form-group col-md-4">
		    <label for="exampleFormControlSelect1">de:</label>
		    <select class="form-control"  name="abre" >
		      <option {{Auth::user()->barbearia->abre == '00:00:00' ? 'selected' : ''}}>00:00</option>
		      <option {{Auth::user()->barbearia->abre == '01:00:00' ? 'selected' : ''}}>01:00</option>
		      <option {{Auth::user()->barbearia->abre == '02:00:00' ? 'selected' : ''}}>02:00</option>
		      <option {{Auth::user()->barbearia->abre == '03:00:00' ? 'selected' : ''}}>03:00</option>
		      <option {{Auth::user()->barbearia->abre == '04:00:00' ? 'selected' : ''}}>04:00</option>
		      <option {{Auth::user()->barbearia->abre == '05:00:00' ? 'selected' : ''}}>05:00</option>
		      <option {{Auth::user()->barbearia->abre == '06:00:00' ? 'selected' : ''}}>06:00</option>
		      <option {{Auth::user()->barbearia->abre == '07:00:00' ? 'selected' : ''}}>07:00</option>
		      <option {{Auth::user()->barbearia->abre == '08:00:00' ? 'selected' : ''}}>08:00</option>
		      <option {{Auth::user()->barbearia->abre == '09:00:00' ? 'selected' : ''}}>09:00</option>
		      <option {{Auth::user()->barbearia->abre == '10:00:00' ? 'selected' : ''}}>10:00</option>
		      <option {{Auth::user()->barbearia->abre == '11:00:00' ? 'selected' : ''}}>11:00</option>
		      <option {{Auth::user()->barbearia->abre == '12:00:00' ? 'selected' : ''}}>12:00</option>
		      <option {{Auth::user()->barbearia->abre == '13:00:00' ? 'selected' : ''}}>13:00</option>
		      <option {{Auth::user()->barbearia->abre == '14:00:00' ? 'selected' : ''}}>14:00</option>
		      <option {{Auth::user()->barbearia->abre == '15:00:00' ? 'selected' : ''}}>15:00</option>
		      <option {{Auth::user()->barbearia->abre == '16:00:00' ? 'selected' : ''}}>16:00</option>
		      <option {{Auth::user()->barbearia->abre == '17:00:00' ? 'selected' : ''}}>17:00</option>
		      <option {{Auth::user()->barbearia->abre == '18:00:00' ? 'selected' : ''}}>18:00</option>
		      <option {{Auth::user()->barbearia->abre == '19:00:00' ? 'selected' : ''}}>19:00</option>
		      <option {{Auth::user()->barbearia->abre == '20:00:00' ? 'selected' : ''}}>20:00</option>
		      <option {{Auth::user()->barbearia->abre == '21:00:00' ? 'selected' : ''}}>21:00</option>
		      <option {{Auth::user()->barbearia->abre == '22:00:00' ? 'selected' : ''}}>22:00</option>
		      <option {{Auth::user()->barbearia->abre == '23:00:00' ? 'selected' : ''}}>23:00</option>
		      <option {{Auth::user()->barbearia->abre == '24:00:00' ? 'selected' : ''}}>24:00</option>
		    </select>
		</div>
		<div class="form-group col-md-4">
		    <label for="exampleFormControlSelect1">até:</label>
		    <select class="form-control"  name="fecha" >
		      <option {{Auth::user()->barbearia->fecha == '00:00:00' ? 'selected' : ''}}>00:00</option>
		      <option {{Auth::user()->barbearia->fecha == '01:00:00' ? 'selected' : ''}}>01:00</option>
		      <option {{Auth::user()->barbearia->fecha == '02:00:00' ? 'selected' : ''}}>02:00</option>
		      <option {{Auth::user()->barbearia->fecha == '03:00:00' ? 'selected' : ''}}>03:00</option>
		      <option {{Auth::user()->barbearia->fecha == '04:00:00' ? 'selected' : ''}}>04:00</option>
		      <option {{Auth::user()->barbearia->fecha == '05:00:00' ? 'selected' : ''}}>05:00</option>
		      <option {{Auth::user()->barbearia->fecha == '06:00:00' ? 'selected' : ''}}>06:00</option>
		      <option {{Auth::user()->barbearia->fecha == '07:00:00' ? 'selected' : ''}}>07:00</option>
		      <option {{Auth::user()->barbearia->fecha == '08:00:00' ? 'selected' : ''}}>08:00</option>
		      <option {{Auth::user()->barbearia->fecha == '09:00:00' ? 'selected' : ''}}>09:00</option>
		      <option {{Auth::user()->barbearia->fecha == '10:00:00' ? 'selected' : ''}}>10:00</option>
		      <option {{Auth::user()->barbearia->fecha == '11:00:00' ? 'selected' : ''}}>11:00</option>
		      <option {{Auth::user()->barbearia->fecha == '12:00:00' ? 'selected' : ''}}>12:00</option>
		      <option {{Auth::user()->barbearia->fecha == '13:00:00' ? 'selected' : ''}}>13:00</option>
		      <option {{Auth::user()->barbearia->fecha == '14:00:00' ? 'selected' : ''}}>14:00</option>
		      <option {{Auth::user()->barbearia->fecha == '15:00:00' ? 'selected' : ''}}>15:00</option>
		      <option {{Auth::user()->barbearia->fecha == '16:00:00' ? 'selected' : ''}}>16:00</option>
		      <option {{Auth::user()->barbearia->fecha == '17:00:00' ? 'selected' : ''}}>17:00</option>
		      <option {{Auth::user()->barbearia->fecha == '18:00:00' ? 'selected' : ''}}>18:00</option>
		      <option {{Auth::user()->barbearia->fecha == '19:00:00' ? 'selected' : ''}}>19:00</option>
		      <option {{Auth::user()->barbearia->fecha == '20:00:00' ? 'selected' : ''}}>20:00</option>
		      <option {{Auth::user()->barbearia->fecha == '21:00:00' ? 'selected' : ''}}>21:00</option>
		      <option {{Auth::user()->barbearia->fecha == '22:00:00' ? 'selected' : ''}}>22:00</option>
		      <option {{Auth::user()->barbearia->fecha == '23:00:00' ? 'selected' : ''}}>23:00</option>
		      <option {{Auth::user()->barbearia->fecha == '24:00:00' ? 'selected' : ''}}>24:00</option>
		    </select>
		</div>
		<br>
		<button type="submit" class="btn btn-primary">Salvar</button>
		</form>
		</div>
	</div>

		

	</div>
    	@endif
    </div>

</div>


</div>


















<!-- modal pagamento -->

<!-- Modal -->
@if(Auth::user()->barbearia and Auth::user()->barbearia->ativacao == 0)

@foreach($planos as $p)

<div class="modal fade" id="modalPagamento{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Plano {{$p->nome}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
      	<br>

		<ul class="list-unstyled mt-3 mb-4">
		   <li><h1>R${{number_format($p->valor, 2, ',', '')}}</h1></li>
		</ul>
		<form id="frmPagamento{{$p->id}}" action="/painel/barbearia/pagamentos" method="post">
			<input type="hidden" name="_token" 		value="{{csrf_token()}}">
			<input type="hidden" name="plano_id" 	value="{{$p->id}}">
			<input type="hidden" name="barbearia_id" value="{{Auth::user()->barbearia->id}}">

		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

        <button type="submit" class="btn btn-primary" form="frmPagamento{{$p->id}}">Contratar</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endif
<!-- Modal Criar Barbearia -->
<div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Barbearia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        <form id="formAdicionar" method="post" action="{{url('painel/barbearia/loja')}}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="ativacao" value="0" >
        	Nome:
		    <input type="text" class="form-control" name="nome" placeholder="Nome">
		    Telefone:
		    <input type="text" class="telefone form-control" name="telefone" placeholder="Telefone">
		    Email:
		    <input type="email" class="form-control" name="email" placeholder="Email">
		    Cidade:
		    <select class="custom-select" name="cidade_id">
		    @foreach($cidades as $c)
			  <option value="{{$c->id}}">{{$c->nome}} - [{{$c->uf}}]</option>
			 @endforeach
			</select>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" form="formAdicionar">Enviar pedido</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal Alterar Barbearia -->

<!-- Botão para acionar modal -->

@if(Auth::user()->barbearia and Auth::user()->barbearia->ativacao == 1)

<!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form id="formAlterar" method="post" action="{{url('painel/barbearia/loja/'. Auth::user()->barbearia->id)}}"  enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{csrf_token()}}" >
			<input type="hidden" name="_method" value="PUT" >
		    Descricao:
		    <input type="text" class="form-control" name="razao" placeholder="Descricao" value="{{Auth::user()->barbearia->razao}}">
		    Cnpj:
		    <input type="text" class="cnpj form-control" name="cnpj" placeholder="Cpf" value="{{Auth::user()->barbearia->cnpj}}">
		    Rg:
		    <input type="text" class="form-control" name="ie" placeholder="RG" value="{{Auth::user()->barbearia->ie}}">
		    Telefone:
		    <input type="text" class="telefone form-control" name="telefone" placeholder="Telefone" value="{{Auth::user()->barbearia->telefone}}">
		    Celular:
		    <input type="text" class="telefone form-control" name="celular" placeholder="Celular" value="{{Auth::user()->barbearia->celular}}">
		    Email:
		    <input type="text" class="form-control" name="email" placeholder="Email" value="{{Auth::user()->barbearia->email}}">
		    Cep:
		    <input type="text" class="form-control" name="cep" placeholder="Cep" value="{{Auth::user()->barbearia->cep}}">
		    Numero:
		    <input type="text" class="form-control" name="numero" placeholder="Numero" value="{{Auth::user()->barbearia->numero}}">
		    Endereco:
		    <input type="text" class="form-control" name="endereco" placeholder="Endereco" value="{{Auth::user()->barbearia->endereco}}">
		    Logo
			<div class="custom-file">
			<input type="file" class="custom-file-input" name="image">
			<label class="custom-file-label" for="inputGroupFile01">Escolha uma imagem</label>
			</div>

		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary" form="formAlterar">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>
@endif


<script type="text/javascript">
$(document).ready(function(){
    $('.telefone').mask('(00) 00000-0000');
    $('.cnpj').mask('00.000.000/0000-00');
    $('.cep').mask('00000-000');
    $('.ie').mask('0000000000');
});
</script>



@endsection
