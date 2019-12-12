@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Profissionais</h3></div>

    <div class="shadow-sm p-3 mb-5 bg-white"> 
    	<button class="btn btn-link"  data-toggle="modal" data-target="#modalAdicionar">Novo</button>

		<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="50%">Nome</th>
		      <th scope="col">Ação</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach(Auth::user()->barbearia->barbeiros as $b)
		    <tr>
		      	<td>{{$b->nome}}</td>
		      	<td>
		      	<button class="btn btn-primary  btn-sm"  data-toggle="modal" data-target="#modalAlterar{{$b->id}}">Editar</button> - 
		      	<button form="formDeletar{{$b->id}}" type="submit" class="btn btn-danger btn-sm" >Deletar</button>
		          <form id="formDeletar{{$b->id}}" action="/painel/barbearia/barbeiros/{{ $b->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este barbeiro')">
		            <input type="hidden" name="_method" value="DELETE">   
		            <input type="hidden" name="_token" value="{{csrf_token()}}">
		          </form>
		  		</td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
    </div>
</div>



<!-- Modal Criar Barbearia -->
			<div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Barbeiro</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body text-left">
			        <form id="formAdicionar" method="post" action="{{url('painel/barbearia/barbeiros')}}"  enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
						<input type="hidden" name="barbearia_id" value="{{Auth::user()->barbearia->id}}">
			        	Código do barbeiro:
					    <input type="number" class="form-control" name="user_id" placeholder="Código" required>
			        	Nome:
					    <input type="text" class="form-control" name="nome" placeholder="Nome">
					    Descricao:
					    <input type="text" class="form-control" name="descricao" placeholder="Descricao">
					    Cpf:
					    <input type="text" class="cpf form-control" name="cpf" placeholder="Cpf">
					    Rg:
					    <input type="text" class="form-control" name="RG" placeholder="RG">
					    Telefone:
					    <input type="text" class="telefone form-control" name="telefone" placeholder="Telefone">
					    Celular:
					    <input type="text" class="telefone form-control" name="celular" placeholder="Celular">
					    Email:
					    <input type="email" class="form-control" name="email" placeholder="Email">
					    Foto:
						<div class="custom-file">
						<input type="file" class="custom-file-input" name="image">
						<label class="custom-file-label" for="inputGroupFile01">Escolha uma imagem</label>
						</div>

					</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary" form="formAdicionar">Cadastrar</button>
			      </div>
			    </div>
			  </div>
			</div>





<!-- Modal Alterar Barbearia -->
@foreach(Auth::user()->barbearia->barbeiros as $b)
			<div class="modal fade" id="modalAlterar{{$b->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Barbeiro</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body text-left">
			      	<img src="{{url('/imagens/'.$b->foto)}}" width="200px" class="rounded mx-auto d-block">
			        <form id="formAlterar{{$b->id}}" method="post" action="{{url('painel/barbearia/barbeiros/'.$b->id)}}"  enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
						<input type="hidden" name="_method" value="PUT" >
						<input type="hidden" name="id" value="{{$b->id}}">
						Nome:
					    <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{$b->nome}}">
					    Descricao:
					    <input type="text" class="form-control" name="descricao" placeholder="Descricao" value="{{$b->descricao}}">
					    Cpf:
					    <input type="text" class="cpf form-control" name="cpf" placeholder="Cpf" value="{{$b->cpf}}">
					    Rg:
					    <input type="text" class="form-control" name="rg" placeholder="RG" value="{{$b->rg}}">
					    Telefone:
					    <input type="text" class="telefone form-control" name="telefone" placeholder="Telefone" value="{{$b->telefone}}">
					    Celular:
					    <input type="text" class="telefone form-control" name="celular" placeholder="Celular" value="{{$b->celular}}">
					    Email:
					    <input type="email" class="form-control" name="email" placeholder="Email" value="{{$b->email}}">
					    Foto:
						<div class="custom-file">
						<input type="file" class="custom-file-input" name="image">
						<label class="custom-file-label" for="inputGroupFile01">Escolha uma imagem</label>
						</div>

					</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary" form="formAlterar{{$b->id}}">Salvar</button>
			      </div>
			    </div>
			  </div>
			</div>
@endforeach



<script type="text/javascript">
$(document).ready(function(){
    $('.telefone').mask('(00) 00000-0000');
    $('.cpf').mask('000.000.000-00');
});	
</script>
@endsection
