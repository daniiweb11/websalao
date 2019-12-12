@extends('layouts.menu')

@section('categoria')
<div class="card">
    <div class="card-header">BARBEARIAS</div>
    	<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Telefone</th>
		      <th scope="col">Plano</th>
		      <th scope="col">Valor</th>
		      <th scope="col">Pagamento</th>
		      <th scope="col">Ação</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($barbearias as $b)
		    <tr class="{{$b->ativacao == 0? 'alert alert-danger' : ''}}">
		      <th scope="row">{{$b->id}}</th>
		      <td>{{$b->nome}}</td>
		      <td>{{$b->telefone}}</td>
		      <td>{{$b->pagamentos->last()->plano->nome ?? ''}}</td>
		      <td>{{$b->pagamentos->last()->valor ?? ''}}</td>
		      <td><a href="https://www.blockchain.com/btc/tx/{{$b->pagamentos->last()->comprovante ?? ''}}" target="_blank">{{$b->pagamentos->last()->comprovante ?? ''}} </a></td>
		      <td class="{{$b->ativacao == 0? 'link-danger' : 'link-success'}}">
		      	<a href="{{$b->ativacao == 0? url('/painel/admin/barbearias/'.$b->id) : url('/painel/admin/barbearias/'.$b->id)}}" class="alert-link">{{$b->ativacao == 0? 'Ativar' : 'Desativar'}}</a>
		      </td>
		    </tr>
    		@endforeach
		  </tbody>
		</table>

    	
    <div class="card-body">
    </div>
</div>
@endsection
