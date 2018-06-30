@extends('crudbooster::admin_template')
@section('content')

<div class="container-fluid">

  <h1>Produtos</h1>
  

  <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
              <td>Cod.</td>
              <td>Nome</td>
              <td>Valor</td>
              <td>Colaber</td>
              <td>Est. Feira</td>
              <td>Remessa Feira</td>
              <td>Est. Casa</td>
              <td>Remessa Casa</td>
            </tr>
        </thead>


  <tbody>
      

  @foreach($produtos as $p)    
      <tr>
              <td>{{$p->codigo}}</td>
              <td>{{$p->nome}}</td>
              <td>{{$p->valor}}</td>
              <td>{{$p->colaber->marca}}</td>
              <td>
             {{$p->entrada_estoque_casa_count - $p->saida_estoque_casa_count}}
              </td>
              <td></td>
              <td>{{$p->entrada_estoque_casa_count - $p->saida_estoque_casa_count}}</td>
              <td></td>
            </tr>      
@endforeach

  </tbody>

<tfoot>
            <tr>
              <th>Cod.</th>
              <th>Nome</th>
              <th>Valor</th>
              <th>Colaber</th>
              <th>Est. Feira</th>
              <th>Remessa Feira</th>
              <th>Est. Casa</th>
              <th>Remessa Casa</th>
            </tr>
        </tfoot>
 
</table>

  </div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>




@endsection

