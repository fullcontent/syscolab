@extends('crudbooster::admin_template')
@section('content')

<div class="container-fluid">

  <h1>Listagem de Colabers</h1>
<table class="table table-striped table-bordered dataTable" role="grid" id="colabers" cellspacing="0" width="100%">  
  <thead>
    
  
  <tr>
    <th>Colaber</th>
    <th>Email</th>
    <th>Responsável</th>
    <th>CNPJ</th>
    <th>CPF</th>
    <th>Telefone</th>
    <th>Dados Bancários</th>
      
  </tr>
  </thead>

  <tbody>
    
  

@foreach($colabers as $c)
  <tr>
      <td>{{$c->marca}}</td>
      <td>{{$c->email}}</td>
      <td>{{$c->responsavel}}</td>
      <td>{{$c->cnpj}}</td>
      <td>{{$c->cpf}}</td>
      <td>{{$c->telefone}}</td>
      <td>{{$c->dadosBancarios}}</td>

  </tr>
@endforeach
</tbody>

</table>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#colabers').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false,
      'order'       :[0,'asc']
    })
  })
</script>


@endsection


