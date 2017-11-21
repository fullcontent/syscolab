@extends('crudbooster::admin_template')

@section('content')




<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$numProdutos}}</h3>

              <p>Produtos Cadastrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$numUsuarios}}</h3>

              <p>Colaber Cadastrado</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Mais informações<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



@endsection