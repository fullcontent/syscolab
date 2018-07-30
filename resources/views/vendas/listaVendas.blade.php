@extends('crudbooster::admin_template')
@section('content')

<div class="container-fluid">

  <h1>Listagem de Vendas</h1>
  <table class="table table-striped">
  
  
  <tr>
    <th>#</th>
    <th>Vendedor</th>
    <th>Data</th>
    <th>Valor</th>
    <th>Pagamento</th>
    <th>Local</th>
    <th width="200"></th>
    
    
  </tr>
@foreach ($vendas as $p)
  <tr>
  <td>{{$p->id}}</td>
  <td>{{$p->user->name}}</td>
  <td>{{date('d/m/Y', strtotime($p->created_at))}}</td>
  <td>R${{$p->valorVenda}}</td>
  <td>{{$p->tipoPagamento}}</td>
  <td>{{$p->localVenda}}</td>
  <td>
       <a href="{{route('venda', ['id'=>$p->id])}}"><button class="btn btn-primary">Detalhar</button></a>

    <a href="{{route('delete.venda', ['id'=>$p->id])}}" onclick="return confirm('Tem certeza que deseja excluir a venda?')"><button class="btn btn-danger" data-toggle="confirmation">Excluir</button></a>
</td>
</tr>

@endforeach
</table>

{{$vendas->links()}}

  </div>



@endsection