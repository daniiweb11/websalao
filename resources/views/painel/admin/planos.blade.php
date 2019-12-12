@extends('layouts.menu')

@section('categoria')

<div class="bg-dark text-white "><h3>Planos</h3></div>
    <div class="shadow-sm p-3 mb-5 bg-white"> 
	<button class="btn btn-link"  data-toggle="modal" data-target="#modalAdicionar">Novo</button>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Valor</th>
		      <th scope="col">Ação</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($planos as $p)
		    <tr>
		      	<th scope="row">{{$p->id}}</th>
		      	<td>{{$p->nome}}</td>
		      	<td>{{$p->valor}}</td>
		      	<td>
		      	<button class="btn btn-link"  data-toggle="modal" data-target="#modalAlterar{{$p->id}}">Editar</button> - 
		      	<button form="formDeletar{{$p->id}}" type="submit" class="btn btn-link" >Deletar</button>
		          <form id="formDeletar{{$p->id}}" action="/painel/admin/planos/{{ $p->id }}" method="POST">
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



<!-- Modal Criar plano -->
			<div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Plano</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body text-left">
			        <form id="formAdicionar" method="post" action="{{url('painel/admin/planos')}}"  enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
			        	Nome:
					    <input type="text" class="form-control" name="nome" placeholder="Nome">
					    Descricao:
					    <input type="text" class="form-control" name="descricao" placeholder="Descricao">
					    Valor:
					    <input type="text" class="form-control" name="valor" placeholder="Valor" step="0.01" >		    
					    Duração:
					    <input type="number" class="form-control" name="duracao" placeholder="Duração" value="{{$p->duracao}}">


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
@foreach($planos as $p)
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
			        <form id="formAlterar{{$p->id}}" method="post" action="{{url('painel/admin/planos/'.$p->id)}}"  enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}" >
						<input type="hidden" name="_method" value="PUT" >
						<input type="hidden" name="id" value="{{$p->id}}">
			        	Nome:
					    <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{$p->nome}}">
					    Descricao:
					    <input type="text" class="form-control" name="descricao" placeholder="Descricao" value="{{$p->descricao}}">
					    Valor:
					    <input type="text" class="form-control" name="valor" placeholder="Valor" value="{{$p->valor}}" step="0.01" >					    
					    Duração:
					    <input type="number" class="form-control" name="duracao" placeholder="Duração" value="{{$p->duracao}}">


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
