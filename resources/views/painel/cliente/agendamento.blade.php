@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Agendamentos</h3></div>

    <div class="shadow-sm p-3 mb-5 bg-white">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
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
			  	@foreach(Auth::user()->agendamentos as $a)
			  	@if($a->status == 0 and $a->deleted_at == null and $a->data >= date('Y-m-d'))
			    <tr class="{{$a->trashed() ? 'alert-danger' :( $a->status == 1 ? 'alert-dark' : '')}}">

					
							    
			      	<th scope="row">
			      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
					    	{{date('d/m/Y', strToTime($a->data)) . ' ' . $a->hora}}

					  	</a> 
					  	<div class="collapse" id="collapseAgendamento{{$a->id}}">
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
							      <th scope="row">Profissional:</th>
							      <td>{{$a->barbeiro->nome}}</td>
							    </tr>
							    <tr>
							      <th scope="row">Horários:</th>
							      <td><button class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modalHorarios{{$a->id}}">Ver horários do dia</button></td>
							    </tr>
							    <tr>
							      <td>
							      	@if($a->status == 0 )
							      	
							      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar{{$a->id}}">Cancelar</button>
							      	<form id="frmCancelar{{$a->id}}" action="/painel/cliente/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento? {{$a->id}}')">
							      		<input type="hidden" name="_token" value="{{csrf_token()}}">
							      		<input type="hidden" name="_method" value="delete">
							      	</form>
							      	@else
										<p>Finalizado</p>
							      	@endif
							      </td>
							      <th scope="row"></th>
							    </tr>
							</table>
							<!-- modal -->
							<div class="modal fade" id="modalHorarios{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Horários do dia</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<table>
							      	<tr>
							      		<th>#</th>
							      		<th>Data</th>
							      		<th>Hora</th>
							      		<th>Salão</th>
							      	</tr>
							      	@for($i = substr($a->barbearia->abre, 0,2); $i < substr($a->barbearia->fecha,0,2); $i++)
							      	@if($a->data != date('Y-m-d'))
							      	<tr class=" {{in_array($i, $a->barbearia->horarios2($a->data)) ? 'alert-danger':''}} {{$i.':00'==$a->hora? 'text-success': ''}}">
							      		<td>
							      		@if(!in_array($i, $a->barbearia->horarios2($a->data)) )
							      			<a href="/painel/cliente/agendamentos/remarcar/{{$a->id}}/{{$i}}">Remarcar</a>
							      		@endif
							      		</td>
							      		<td>{{date('d/m/Y', strtotime($a->data))}}</td>
							      		<td>{{$i.':00'}}</td>
							      		<td>{{$a->barbearia->nome}}</td>
							      	</tr>
							      	@endif
							      	@if($a->data == date('Y-m-d'))
							      	@if($i > date('H'))
							      	<tr class=" {{in_array($i, $a->barbearia->horarios2($a->data)) ? 'alert-danger':''}} {{$i.':00'==$a->hora? 'text-success': ''}}">
							      		<td>
							      		@if(!in_array($i, $a->barbearia->horarios2($a->data)) )
							      			<a href="/painel/cliente/agendamentos/remarcar/{{$a->id}}/{{$i}}">Remarcar</a>
							      		@endif
							      		</td>
							      		<td>{{date('d/m/Y', strtotime($a->data))}}</td>
							      		<td>{{$i.':00'}}</td>
							      		<td>{{$a->barbearia->nome}}</td>
							      	</tr>
							      	@endif
							      	@endif
							      	@endfor
							      	</table>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
							      </div>
							    </div>
							  </div>
							</div>

						</div>
					</th>
					<td><a href="{{url($a->barbearia->nome)}}">{{$a->barbearia->nome}}</a></td>
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
			  	@foreach(Auth::user()->agendamentos as $a)
			  	@if($a->status == 1 and $a->deleted_at == null)

			    <tr class="{{$a->trashed() ? 'alert-danger' :( $a->status == 1 ? 'alert-dark' : '')}}">

					
							    
			      	<th scope="row">
			      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
					    	{{date('d/m/Y', strToTime($a->data)) . ' ' . $a->hora}}

					  	</a> 
					  	<div class="collapse" id="collapseAgendamento{{$a->id}}">
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
							      <td>
							      	@if($a->status == 0 )
							      	
							      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar{{$a->id}}">Cancelar</button>
							      	<form id="frmCancelar{{$a->id}}" action="/painel/cliente/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento? {{$a->id}}')">
							      		<input type="hidden" name="_token" value="{{csrf_token()}}">
							      		<input type="hidden" name="_method" value="delete">
							      	</form>
							      	@else
										<p>Finalizado</p>
							      	@endif
							      </td>
							      <th scope="row"></th>
							    </tr>
							</table>
						</div>
					</th>
					<td><a href="{{url($a->barbearia->nome)}}">{{$a->barbearia->nome}}</a></td>
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
			  	@foreach(Auth::user()->agendamentos as $a)
			  	@if($a->deleted_at != null)
			    <tr class="{{$a->trashed() ? 'alert-danger' :( $a->status == 1 ? 'alert-dark' : '')}}">

					
							    
			      	<th scope="row">
			      		<a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseAgendamento{{$a->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
					    	{{date('d/m/Y', strToTime($a->data)) . ' ' . $a->hora}}

					  	</a> 
					  	<div class="collapse" id="collapseAgendamento{{$a->id}}">
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
							      <td>
							      	@if($a->status == 0 )
							      	
							      	<button class="btn btn-danger btn-sm" type="submit" data-toggle="modal" form="frmCancelar{{$a->id}}">Cancelar</button>
							      	<form id="frmCancelar{{$a->id}}" action="/painel/cliente/agendamentos/{{$a->id}}" method="post"  onSubmit="return confirm('Deseja realmente cancelar este agendamento? {{$a->id}}')">
							      		<input type="hidden" name="_token" value="{{csrf_token()}}">
							      		<input type="hidden" name="_method" value="delete">
							      	</form>
							      	@else
										<p>Finalizado</p>
							      	@endif
							      </td>
							      <th scope="row"></th>
							    </tr>
							</table>
						</div>
					</th>
					<td><a href="{{url($a->barbearia->nome)}}">{{$a->barbearia->nome}}</a></td>
			    </tr>
			    @endif
			    @endforeach
			  </tbody>
			</table>
		  </div>
		</div>    
		
    </div>






@endsection
