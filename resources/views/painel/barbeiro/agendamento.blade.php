@extends('layouts.menu')

@section('categoria')



<div class="bg-dark text-white "><h3>Agendamentos</h3></div>

<div class="shadow-sm p-3 mb-5 bg-white">
<ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Em andamento</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Finalizados</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Cancelados</a>
  </li>
</ul>




<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  	<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">Serviços</th>
		      <th scope="col">Salão</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach(Auth::user()->barbeiro->agendamentos as $a)
		  	@if($a->status == 0 and $a->deleted_at == null)
		    <tr class="{{$a->trashed() ? 'alert-danger' :( $a->status == 1 ? 'alert-dark' : '')}}">
		      	<th scope="row">
		      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento1{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	{{date('d-m-Y', strtotime($a->data))  . ' ' . $a->hora}}
				  	</a> 
				  	<div class="collapse" id="collapseAgendamento1{{$a->id}}">
					    <table class="table table-sm">

						    <tr>
						      <th scope="row" width="10%">Corte:</th>
						      <td>{{$a->corte->nome}}</td>
						    </tr>
						    <tr>
						      <th scope="row">Preço:</th>
						      <td>R$ {{number_format($a->corte->valor,2, ",", "")}}</td>
						    </tr>
						    <tr>
						      <th scope="row">Profissional:</th>
						      <td>{{$a->barbeiro->nome}}</td>
						    </tr>
						    <tr>
						      <th scope="row">cliente:</th>
						      <td>{{$a->cliente->name ?? $a->nome }}</td>
						    </tr>
						    <tr>
						      <th scope="row"></th>
						      <td>
						      	@if($a->trashed())
						      	<p>Cancelado</p>
						      	@elseif($a->status == 1 )
						      	<p>Finalizado</p>
						      	@else
						      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar{{$a->id}}">Cancelar</button>
						      	<form id="frmCancelar{{$a->id}}" action="/painel/barbeiro/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento?')">
						      		<input type="hidden" name="_token" value="{{csrf_token()}}">
						      		<input type="hidden" name="_method" value="delete">
						      	</form>
						      	@endif
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
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  	<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">Cortes</th>
		      <th scope="col">Barbearia</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach(Auth::user()->barbeiro->agendamentos as $a)
		  	@if($a->status == 1 and $a->deleted_at == null)

		    <tr class="{{$a->trashed() ? 'alert-danger' :( $a->status == 1 ? 'alert-dark' : '')}}">
		      	<th scope="row">
		      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento2{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	{{date('l, d-m-Y', strtotime($a->data))  . ' ' . $a->hora}}
				  	</a> 
				  	<div class="collapse" id="collapseAgendamento2{{$a->id}}">
					    <table class="table table-sm">

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
						      <th scope="row"></th>
						      <td>
						      	@if($a->trashed())
						      	<p>Cancelado</p>
						      	@elseif($a->status == 1 )
						      	<p>Finalizado</p>
						      	@else
						      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar{{$a->id}}">Cancelar</button>
						      	<form id="frmCancelar{{$a->id}}" action="/painel/barbeiro/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento?')">
						      		<input type="hidden" name="_token" value="{{csrf_token()}}">
						      		<input type="hidden" name="_method" value="delete">
						      	</form>
						      	@endif
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
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
  	<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">Cortes</th>
		      <th scope="col">Barbearia</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach(Auth::user()->barbeiro->agendamentos as $a)
		  	@if($a->deleted_at != null)

		    <tr class="{{$a->trashed() ? 'alert-danger' :( $a->status == 1 ? 'alert-dark' : '')}}">
		      	<th scope="row">
		      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento3{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
				    	{{date('l, d-m-Y', strtotime($a->data))  . ' ' . $a->hora}}
				  	</a> 
				  	<div class="collapse" id="collapseAgendamento3{{$a->id}}">
					    <table class="table table-sm">

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
						      <th scope="row"></th>
						      <td>
						      	@if($a->trashed())
						      	<p>Cancelado</p>
						      	@elseif($a->status == 1 )
						      	<p>Finalizado</p>
						      	@else
						      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar{{$a->id}}">Cancelar</button>
						      	<form id="frmCancelar{{$a->id}}" action="/painel/barbeiro/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento?')">
						      		<input type="hidden" name="_token" value="{{csrf_token()}}">
						      		<input type="hidden" name="_method" value="delete">
						      	</form>
						      	@endif
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
