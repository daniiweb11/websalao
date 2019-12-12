@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Clientes que frequentaram a 1 mês</h3><a href="/painel/barbearia/alerta/create" class="btn btn-outline-success">Alertar</a></div>

    <div class="shadow-sm p-3 mb-5 bg-white">
    	<div class="row">
		<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">Cortes</th>
		      <th scope="col">Cliente</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($agendamentos as $a)
		    <tr>
		      	<th scope="row">
		      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	{{date('d/m/Y', strtotime($a->data))  . ' às ' . $a->hora}}
				  	</a>
				  	<div class="collapse" id="collapseAgendamento{{$a->id}}">
					    <table class="table table-sm">

						    <tr>
						      <th scope="row" width="10%">Cliente:</th>
						      <td>{{$a->cliente->name}}</td>
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
						      	
						      </td>
						      <th scope="row"></th>
						    </tr>
						</table>
					</div>
				</th>
				<td>{{$a->cliente->name}}</td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
		</div>
    </div>
</div>
@endsection
