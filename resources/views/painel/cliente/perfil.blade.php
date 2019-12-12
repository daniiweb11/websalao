@extends('layouts.menu')

@section('categoria')
<div class="bg-dark text-white "><h3>Perfil</h3></div>
    
<div class="shadow-sm p-3 mb-5 bg-white">
	<div class="row">
		<table class="table table-sm">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col" width="20%">#</th>
		      <th scope="col">Usuário</th>
		    </tr>
		  </thead>
		  <tbody>

			    <tr>
			      <th scope="row" width="10%">Nome:</th>
			      <td>{{Auth::user()->name}}</td>
			    </tr>
			    <tr>
			      <th scope="row">Email:</th>
			      <td>{{Auth::user()->email}}</td>
			    </tr>
		  </tbody>
		</table>
	</div>
</div>
@endsection
