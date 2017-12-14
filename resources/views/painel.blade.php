<link href="{{ asset("vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />

<div class="container">

	<h1>Produtos com codigo duplicado</h1>
	<table class="table">
	
	
	<tr>
		<th>ID</th>
		<th>Codigo</th>
		<th>Nome</th>
		<th>Marca</th>
		
		
	</tr>
@foreach ($produto as $p)
	<tr>
		<td>{{$p->id}}</td>
	<td>{{$p->codigo}}</td>
	<td>{{$p->nome}}</td>
	<td>{{$p->colaber->marca}}</td>
	

</tr>

@endforeach
</table>

</div>
