@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Barbearias frequentadas</h3></div>
    
<div class="shadow-sm p-3 mb-5 bg-white">
	<div class="row">
		<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">Vales</th>
		      <th scope="col" width="20%">Salão</th>
		      <th scope="col" width="20%">Cortes feitos</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach(Auth::user()->fidelizacaos as $f)
			    <tr>
			    	<td>
					  <a  data-toggle="collapse" href="#collapseExample{{$f->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$f->id}}">
					   	vales
					  </a>
					  <div class="collapse" id="collapseExample{{$f->id}}">
						<table>
							<tr>
								<th>Id</th>
								<th>Status</th>
							</tr>
						@foreach($f->vales as $v)
							<tr>
								<td><a href="/painel/cliente/vale/{{$v->id}}" target="_blank">{{$v->id}}</a></td>
								<td class="{{$v->status == 0 ? 'text-success': 'text-danger'}}">{{$v->status == 0 ? 'Válido': 'Usado'}}</td>
							</tr>
						@endforeach
						</table>
					  </div>
				  </td>
			      <th scope="row" width="10%"><a href="{{url($f->barbearia->nome)}}">{{$f->barbearia->nome}}</a></th>
			      @if($f->cortes >= 10)
					<td><a href="#" data-toggle="modal" data-target="#modalExemplo{{$f->id}}">{{$f->cortes}}</a></td>
			      @else
			      <td>{{$f->cortes}}</td>
			      @endif
			     

			    </tr>
				
				<!-- Modal -->
			    <div class="modal fade" id="modalExemplo{{$f->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Vale corte</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body text-center">

				        <h1>{{$f->barbearia->nome}}</h1>
				        <h1>Você tem direito a corte GRÁTIS!</h1>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				        <form action="/painel/cliente/fidelizacao" method="post">
				        	@csrf
				        	<input type="hidden" name="id" value="{{$f->id}}">
				        <button type="submit" href="/painel/fidelizacao/" class="btn btn-primary">Gerar vale</button> 
				        </form>
				      </div>
				    </div>
				  </div>
				</div>
			@endforeach
		  </tbody>
		</table>
	</div>
</div>




@endsection
