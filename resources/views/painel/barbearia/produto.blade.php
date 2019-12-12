@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Produtos</h3></div>

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
		  	@foreach(Auth::user()->barbearia->produtos as $p)
		    <tr>
		      	<td>{{$p->nome}}</td>
		      	<td>
		      	<button class="btn btn-primary  btn-sm"  data-toggle="modal" data-target="#modalAlterar{{$p->id}}">Editar</button> - 
		      	<button form="formDeletar{{$p->id}}" type="submit" class="btn btn-danger btn-sm" >Deletar</button>
		          <form id="formDeletar{{$p->id}}" action="/painel/barbearia/produtos/{{ $p->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este produto')">
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
			        <h5 class="modal-title" id="exampleModalLabel">Barbearia</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body text-left">
			        <form id="formAdicionar" method="post" action="{{url('painel/barbearia/produtos')}}"  enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
						<input type="hidden" name="barbearia_id" value="{{Auth::user()->barbearia->id}}">

			        	Nome:
					    <input type="text" class="form-control" name="nome" placeholder="Nome">
					    Descricao:
					    <input type="text" class="form-control" name="descricao" placeholder="Descricao">
					    Valor:
					    <input type="number" step="any" class="form-control" name="valor" placeholder="Valor">
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
@foreach(Auth::user()->barbearia->produtos as $p)
			<div class="modal fade" id="modalAlterar{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Barbearia</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body text-left">
			      	<img src="{{url('/imagens/'.$p->foto)}}" width="200px" class="rounded mx-auto d-block">
			        <form id="formAlterar{{$p->id}}" method="post" action="{{url('painel/barbearia/produtos/'.$p->id)}}"  enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
						<input type="hidden" name="_method" value="PUT" >
						<input type="hidden" name="id" value="{{$p->id}}">
						Nome:
					    <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{$p->nome}}">
					    Descricao:
					    <input type="text" class="form-control" name="descricao" placeholder="Descricao" value="{{$p->descricao}}">
					    Valor:
					    <input type="number" step="any" class="form-control" name="valor" placeholder="Valor" value="{{$p->valor}}">
					    Foto:
						<div class="custom-file">
						<input type="file" class="custom-file-input" name="image">
						<label class="custom-file-label" for="inputGroupFile01">Escolha uma imagem</label>
						</div>

					</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary" form="formAlterar{{$p->id}}">Salvar</button>
			      </div>
			    </div>
			  </div>
			</div>
@endforeach
@endsection
