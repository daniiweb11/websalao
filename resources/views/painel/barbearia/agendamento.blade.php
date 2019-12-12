@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Agendamentos</h3></div>

    <div class="shadow-sm p-3 mb-5 bg-white">
    	<div class="row">
		<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">Serviços</th>
		      <th scope="col">Barbearia</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach(Auth::user()->barbearia->agendamentos as $a)
		    <tr>
		      	<th scope="row">
		      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	{{date('m/d/Y', strtotime($a->data))  . ' às ' . $a->hora}}
				  	</a>
				  	<div class="collapse" id="collapseAgendamento{{$a->id}}">
					    <table class="table table-sm">

						    <tr>
						      <th scope="row" width="10%">Cliente:</th>
						      <td>{{$a->cliente->name ?? $a->nome}}</td>
						    </tr>
						    <tr>
						      <th scope="row" width="10%">Corte:</th>
						      <td>{{$a->corte->nome}}</td>
						    </tr>
						    <tr>
						      <th scope="row">Preço:</th>
						      <td>{{$a->corte->valor}}</td>
						    </tr>
						    <tr>
						      <th scope="row">Barbeiro:</th>
						      <td>{{$a->barbeiro->nome}}</td>
						    </tr>
						    <tr>
						      <td>
						      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar">Cancelar</button>
						      	<form id="frmCancelar" action="/painel/cliente/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento?')">
						      		<input type="hidden" name="_token" value="{{csrf_token()}}">
						      		<input type="hidden" name="_method" value="delete">
						      	</form>
						      </td>
						      <th scope="row"></th>
						    </tr>
						</table>
					</div>
				</th>
				<td>{{$a->barbearia->nome}}</td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
		</div>
    </div>
</div>
@endsection
