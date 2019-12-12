@extends('layouts.menu')

@section('categoria')

<div class="bg-dark text-white "><h3>Home</h3></div>

    <div class="shadow-sm p-3 mb-5 bg-white">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Seja bem vindo ao painel administrativo!<br>
        @if(Auth::user()->tipo == 'barbeiro')

        	Seu código é:<input class="form-control col-md-1" type="number" value="{{Auth::user()->id}}" readonly onclick="this.select()">
        	@if(!Auth::user()->barbeiro)
        		Você ainda não possui cadastro em barbearia.
        	@endif
        @endif
    </div>
</div>
@endsection
