@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Dashboard</h3></div>
<div class="row">
<div class="col-md-3">
	
	<div class="card" style="width: 18rem;">
	  <div class="card-body">
	    <h5 class="card-title">Faturamento Geral</h5>
      	<h1>R$ {{Auth::user()->barbearia->valor_total()}}</h1>
	  </div>
	</div>
</div>
</div>
<br>
<div class="row">
@foreach(Auth::user()->barbearia->barbeiros as $b)
	<div class="col-md-3">
	<div class="card" style="width: 18rem;">
	  <img class="card-img-top" src="{{asset('imagens/'.$b->foto)}}" alt="Imagem de capa do card">
	  <div class="card-body">
	    <h5 class="card-title">{{$b->nome}}</h5>
      	<div class="list-group list-group-flush">
      		@foreach($b->agendamentos as $a)
      		@if($a->data == date('Y-m-d'))
             <a href="#"    class="list-group-item list-group-item-action  {{$a->status == 1 ? ' bg-success' : ''}} {{$a->deleted_at != null ? ' bg-danger' : ''}}"><b>{{$a->hora}}</b></a>
             @endif
	  		@endforeach
	  	</div>
	  </div>
	</div>	
	</div>
@endforeach
</div>
@endsection
