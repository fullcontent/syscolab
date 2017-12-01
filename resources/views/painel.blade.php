@extends("crudbooster::admin_template")
@section("content")





<div class="container-fluid">
	
<div class="col-md-6">

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
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Novidades:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                
                <div class="carousel-inner">
                  
                  <div class="item active">
                    <img src="http://placehold.it/900x500/39CCCC/ffffff&amp;text=Novidades" alt="First slide">
                  </div>

                   <div class="item">
                    <img src="http://placehold.it/900x500/56DDDC/ffffff&amp;text=Novidades+2+4" alt="First slide">
                  </div>
                  
                  
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

</div>



@endsection