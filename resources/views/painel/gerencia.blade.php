@extends("crudbooster::admin_template")
@section("content")

{!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
{!! Html::script('js/ultimasNoticias.js', array('type' => 'text/javascript')) !!}




<div class="row">
        
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Vendas do Dia</span>
              <span class="info-box-text">{{date('d/m/Y')}}</span>
              <span class="info-box-number">R$ {{$totalVendasDiarioGerencia}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Vendas da Semana</span>
              <span class="info-box-text">{{date("d/m/Y",strtotime("-1 week"))}} a {{date("d/m/Y")}}</span>

              <span class="info-box-number">R$ {{$totalVendasSemanalGerencia}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ticket Médio</span>
              <span class="info-box-number">R$ {{number_format($ticketMedioGerencia,2)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
 



        
</div>

<div class="row">
  <div class="col-md-4">
  
  <div class="box box-primary">
         <div class="box-body">

            <div class="btn-group-vertical btn-block">
                <a href="vendasFeira"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-list-alt"></i> Nova Venda</h4></button></a>
                <a href="estoqueFeira"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-plus"></i> Entrada no estoque</h4></button></a>
                
                
            </div>
        </div>
    </div>

  <div class="box box-warning" ng-app="syscolab" ng-controller="noticiasCtrl">
      <div class="box-body">
        <div class="box-header">
          <h3 class="box-title">Enviar mensagem para todos</h3>
        </div>
        <div class="box-body">@{{log}}</div>
        <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    
              <span class="direct-chat-timestamp pull-right">{{$ultimaNoticiaGerencia->created_at}}</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="{{asset('/vendor/crudbooster/avatar.jpg')}}" alt="img"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                   {{$ultimaNoticiaGerencia->mensagem}}
                  </div>

                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
        <div class="box-footer">
                  <form ng-submit="adicionarNoticia(mensagem)">
                    <div class="input-group">
                      <input type="text" name="mensagem" placeholder="Digite a mensagem" class="form-control" ng-model="mensagem" required>
                      <span class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-flat">Enviar</button>
                          </span>
                    </div>
                  </form>
                </div>
      </div>
  </div>

</div>

<div class="col-md-4">
<div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Produtos mais vendidos</h3>

              
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-hover">
                <tbody>
                   <tr>
                  <th>Qtde</th>
                  <th>Produto</th>
                  <th>Colaber</th>
                  
                </tr>
                
                @foreach($produtosMaisVendidosGerencia as $p)
                  <tr>
                    <td>{{$p->venda_count}}</td>
                    <td>{{$p->nome}}</td>
                    <td>{{$p->colaber->marca}}</td>
                  </tr>
                @endforeach
               
              </tbody>
              </table>
            </div>
            
           
          </div>
</div>

</div>

<div class="col-md-4">
  
  <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Produtos com estoque baixo</h3>

              
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-hover">
                <tbody>
                  <tr>
                  
                  <th>Produto</th>
                  <th>Colaber</th>
                  <th>Qtde</th>
                  
                </tr>
        
              
              @foreach($produtosBaixoEstoqueGerencia as $p)
        
                <tr>
                  
                  <td>{{$p->nome}}</td>
                  <td>{{$p->colaber->marca}}</td>
                  
                  <td><span class="badge bg-red">{{$p->entrada_estoque_count - $p->saida_estoque_count - $p->venda_count}}</span></td>
                </tr>
              @endforeach
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
</div>

</div>
</div>

<div class="row">
  
  

</div>



<div class="container-fluid hidden">
<div class="box">
    <div class="box-header">
      <h3>Produtos Vendidos</h3>
    </div>

    <div class="box-body">

      <div class="row"></div>
          
         
            <table class="table table-striped table-bordered dataTable" role="grid" id="produtosMaisVendidos" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th>Data</th>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Marca</th>
                
                
                
                
                <th>Valor</th>
                
                
            </tr>
        </thead>


        <tbody>

          @if(!empty($produtosVendidosGerencia))

              
            @foreach($produtosVendidosGerencia as $key => $p)
               
            <tr>
               
             <td>@foreach($p['venda'] as $v)
                @if($v === end($p['venda']))
                {{date('d/m/Y', strtotime($v->created_at))}}
                @endif
              
              @endforeach

             </td>
             <td>{{$p[0]->codigo}}</td>
             <td>{{$p[0]->nome}}</td>
             <td>{{$p[0]->colaber->marca}}</td>

              
              <td>R${{$p[0]->venda[0]->valor}}</td>
              
          
          
          </tr>

          
          @endforeach

          

          @endif

          
        </tbody>

        

          </table>

          
          

      
    </div>

</div>


</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#produtosMaisVendidos').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'order'       :[0,'desc']
    })
  })
</script>
@endsection