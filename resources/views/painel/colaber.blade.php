@extends("crudbooster::admin_template")
@section("content")

{!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
{!! Html::script('js/ultimasNoticias.js', array('type' => 'text/javascript')) !!}

<div class="container-fluid">
	
<div class="row">
        
        

        

             
</div>


<div class="col-md-6">
  

<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Importante!</h4>
                Estamos enfrentando dificuldades com acesso a internet no local da feira e, por isso, a atualização do sistema não funcionará em tempo real. Faremos o possível para atualizar a cada 3 dias.
</div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Primeiros Passos</h3>
        </div>

        <div class="box-body">

            <div class="btn-group-vertical btn-block">
                <a href="colaber"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-list-alt"></i> Completar seus dados</h4></button></a>
                <a href="produtos/add"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-plus"></i> Cadastrar seus produtos</h4></button></a>
                <a href="envios/add"><button type="button" class="btn btn-default btn-block"><h4><i class="fa  fa-th-large"></i> Nova Remessa de produtos</h4></button></a>
            </div>
        </div>
    </div>
      
     
          
    
</div>

<div class="col-md-6">
        
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total de Vendas</span>
              <span class="info-box-number">R$ {{$totalVendas}}</span>
            </div>
            <!-- /.info-box-content -->

          </div>
          <!-- /.info-box -->

          
        

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Produtos mais vendidos</h3>

              
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <tbody>
				
				      @foreach($produtosMaisVendidos as $p)
                
                <tr>
                  <td>{{$p->venda_count}}x</td>
                  <td>{{$p->nome}}</td>
                  
                  <td><span class="badge bg-green">R$ {{$p->valor}}</span></td>
                </tr>
                @endforeach
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
			


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Produtos com estoque baixo</h3>

              
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <tbody>
                	<tr>
                  <th style="width: 10px">#</th>
                  <th>Produto</th>
                  <th>Qtde</th>
                  
                </tr>
				
	
				        @foreach($produtosBaixoEstoque as $p)
                <tr>
                  <td>{{$p->id}}</td>
                  <td>{{$p->nome}}</td>
                  
                  <td><span class="badge bg-red">{{$p->entrada_estoque_count - $p->saida_estoque_count - $p->venda_count}}</span></td>
                </tr>
                @endforeach
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>

</div>

</div>

@endsection