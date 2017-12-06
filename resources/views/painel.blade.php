@extends("crudbooster::admin_template")
@section("content")


<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Popularity</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                    </td>
                  </tr>
                  
                  
                  
                  
                  
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>


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