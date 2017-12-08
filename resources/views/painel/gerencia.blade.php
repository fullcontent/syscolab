@extends("crudbooster::admin_template")
@section("content")

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
                <a href="colaber"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-list-alt"></i> Nova Venda</h4></button></a>
                <a href="produtos/add"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-plus"></i> Entrada no estoque</h4></button></a>
            </div>
        </div>
    </div>

  <div class="box box-warning">
      <div class="box-body">
        <div class="box-header">
          <h3 class="box-title">Enviar mensagem para todos</h3>
        </div>

        <div class="box-footer">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Digite a mensagem" class="form-control">
                      <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-flat">Enviar</button>
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
                  
                  <th>Produto</th>
                  <th>Colaber</th>
                  
                </tr>
        
              @foreach($produtosMaisVendidosGerencia as $p)
                <tr>
                  <td>{{$p->nome}}</td>
                  <td>{{$p->colaber->name}}</td>
                </tr>
              @endforeach
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
           
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
                  <td>{{$p->colaber->name}}</td>
                  
                  <td><span class="badge bg-red">{{$p->entrada_estoque_count - $p->saida_estoque_count - $p->venda_count}}</span></td>
                </tr>
              @endforeach
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
</div>

</div>


<div class="container-fluid">

<div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Últimas Vendas</h3>
              </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>#</th>
                  <th>Vendedor</th>
                  <th>Data</th>
                  <th>Pagamento</th>
                  <th>Total</th>
                  
                </tr>

                @foreach($vendas as $v)
                <tr>
                  <td>{{$v->id}}</td>
                  <td>{{$v->user->name}}</td>
                  <td>{{date('d/m/Y', strtotime($v->created_at))}}</td>
                  <td><span class="label label-success">{{$v->tipoPagamento}}</span></td>
                  <td>R$ {{number_format($v->valorVenda,2)}}</td>
                  
                </tr>
               @endforeach
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
</div>

@endsection