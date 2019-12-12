

<!---->
<body  style="width:300px;" onload="self.print();self.close();">

<style type="text/css">
	*{
		padding-right: 15px;
		font-family: 'arial';
	}
	hr{
		border: 1px solid;
	}
	@page{
		margin: 0px;
	}

	td { font-size: 13px; }

</style>
<div style="border:1px solid;" align="center">
<h3>Vale: {{$vale->id}}</h3>

<p>Data: {{date('d/m/Y', strtotime($vale->created_at))}}</p>
<h3>{{$vale->fidelizacao->barbearia->nome}} </h3>
</div>

</body>

