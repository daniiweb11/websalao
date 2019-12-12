@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Agendamentos</h3></div>

    <div class="shadow-sm p-3 mb-5 bg-white">
    	<div class="row">
		<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">Cortes</th>
		      <th scope="col">Barbearia</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach(Auth::user()->barbeiro->agendamentos->where('data', date('Y-m-d')) as $a)
		  	@if($a->status == 0 and !$a->trashed())
		    <tr>
		      	<th scope="row">
		      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	{{date('d-m-Y', strtotime($a->data))  . ' ' . $a->hora}}
				    	
				  	</a> 
				  	<div class="collapse" id="collapseAgendamento{{$a->id}}">
					    <table class="table table-sm">

						    <tr>
						      <th scope="row" width="10%">Corte:</th>
						      <td>{{$a->corte->nome}}</td>
						    </tr>
						    <tr>
						      <th scope="row">Preço:</th>
						      <td>R${{number_format($a->corte->valor,2, ",", "")}}</td>
						    </tr>
						    <tr>
						      <th scope="row">Barbeiro:</th>
						      <td>{{$a->barbeiro->nome}}</td>
						    </tr>
						    <tr>
						      <th scope="row">cliente:</th>
						      <td>{{$a->cliente->name ?? $a->nome }}</td>
						    </tr>
						    <tr>
						      <th scope="row"></th>
						      <td>
						      	<a href="/painel/barbeiro/agendamento/finalizar/{{$a->id}}" onClick="return confirm('Deseja realmente finalizar este agendamento? Sertifique-se de que esteja pago!')" class="btn btn-success btn-sm">Finalizar</a>
						      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar">Cancelar</button>
						      	<form id="frmCancelar" action="/painel/barbeiro/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento?')">
						      		<input type="hidden" name="_token" value="{{csrf_token()}}">
						      		<input type="hidden" name="_method" value="delete">
						      	</form>
						      </td>
						    </tr>
						    <tr>
						   	<td>Vale</td>
						    <td > 	
						    	<form action="/painel/barbeiro/agendamentos/vale" method="post">
						    	@csrf
								<div class="input-group mb-3">
								  <input type="hidden" name="agendamento" value="{{$a->id}}">
								  <input type="text" class="form-control" name="id" placeholder="codigo">
								  <div class="input-group-append">
								    <button type="submit" class="btn btn-outline-success" id="basic-addon2">Usar</button>
								  </div>
								</div>
								</form>
								</td>
						    </tr>
						</table>
					</div>
				</th>
				<td>{{$a->barbearia->nome}}</td>
		    </tr>
		    @endif
		    @endforeach
		  </tbody>
		</table>
		</div>
    </div>
</div>






@endsection
