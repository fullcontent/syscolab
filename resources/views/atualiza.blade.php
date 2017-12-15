@extends("crudbooster::admin_template")
@section("content")



<div class="container-fluid">
	

<div class="col-md-4">
	<div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Atualizações de conteúdo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="lead">Aqui o sistema irá sincronizar os dados com o servidor web para que os Colabers fiquem sabendo das vendas.</p>

            </div>
            <!-- /.box-body -->
          </div>
</div>


	
<div class="col-md-4">
	
<div class="box box-solid">
	

<div class="box-header with-border"><h3>Alertas</h3></div>

@foreach($mensagens as $m)
	
	

	<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> {!!$m['enviosRemoto']!!}</h4>
                
    </div>

    <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> {!!$m['produtosRemotos']!!}</h4>
                
    </div>
    <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> {!!$m['estoqueRemoto']!!}</h4>
                
    </div>

    <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> {!!$m['estoqueLocal']!!}</h4>
                
    </div>
    <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> {!!$m['envioItensRemoto']!!}</h4>
                
    </div>
    <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> {!!$m['vendas']!!}</h4>
                
    </div>

	<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> {!!$m['vendasItens']!!}</h4>
                
    </div>

	


@endforeach
			
</div>
</div>	

	


</div>





@endsection