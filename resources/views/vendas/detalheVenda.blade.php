@extends('crudbooster::admin_template')
@section('content')


<div class="container-fluid">

<section class="invoice">
	
	
<div class="row">
	<div class="col-xs-12">
		<h2 class="page-header">Detalhes da Venda #{{$venda->id}}</h2>
	</div>
</div>

<div class="row invoice-info">
	
	<div class="col-md-4 invoice-col">
		
		<label for="">Data:</label>
		<h4>{{date('d/m/Y', strtotime($venda->created_at))}}</h4>

	</div>

	<div class="col-md-4 invoice-col">
		
		<label>Total:</label>
		<h4>R$ {{$venda->valorVenda}}</h4>

	</div>

	<div class="col-md-4 invoice-col">
		
		<label>Forma de Pagamento:</label>
		<h4><span class="label label-success">{{$venda->tipoPagamento}}</span></h4>

	</div>

	

</div>

<hr>

<div class="row">
	
	<div class="col-xs-12 table-responsive">
		
		<table class="table table-striped">
            <thead>
            <tr>
              <th>Qtde</th>
              <th>Codigo</th>
              <th>Produto</th>
              <th>Marca</th>
              <th>SubTotal</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($lista as $l)
				
				@foreach($l->produto as $p)
           		<tr>
					<td>{{$l->qtde}}</td>
					<td>{{$p->codigo}}</td>
					<td>{{$p->nome}}</td>
					<td>{{$p->colaber->marca}}</td>
					<td>R$ {{$l->valor}}</td>
					
					<td><a href="../vendas/estornar/{{$l->id}}/{{$venda->id}}" onclick="return confirm('Tem certeza que estornar o item?')"><button type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button></a></td>
				</tr>
           		@endforeach
            
            @endforeach
            </tbody>
          </table>
	</div>
</div>
<hr>
<div class="row">
	
<a href="../vendas"><button type="button" class="btn btn-success"><i class="fa fa-arrow-left"></i> Voltar para Listagem</button></a>
<a href="../vendas/delete/{{$venda->id}}" onclick="return confirm('Tem certeza que deseja excluir a venda?')"><button type="button" class="btn btn-danger pull-right"><i class="fa fa-remove"></i> Excluir Venda</button></a>
</div>


</section>




</div>



@endsection