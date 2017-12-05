@extends('crudbooster::admin_template')
@section('content')


<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script language="javascript">




    function DoCheckLength(aTextBox) { 
      if (aTextBox.maxLength - aTextBox.value.length==0) { 
         document.theForm.submit(); 
        //beep.play(); 
      } 
    } 
    
window.setTimeout(function() {
    $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 1000);


  </script>
<div class="container-fluid">


@if($message == 'notFound')	

				<div class="alert alert-danger alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-ban"></i> Ops!</h4>
	                O produto não foi encontrado, por favor tente novamente.
              	</div>
@elseif ($message == 'ok')

				<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-check"></i> Legal!</h4>
	                O produto foi adicionado ao estoque.
              	</div>

@elseif ($message == 'add')

				<div class="alert alert-info alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-plus"></i> Adicionando produto</h4>
	                Scaneie ou digite o código do produto.
              	</div>              	

@endif

<div class="col-xs-12">

<div class="box">
	
	<form class="form-horizontal style-form" name="theForm" action="" method="post">

		 {{ csrf_field() }}

       <input class="form-control" type="text" autofocus maxlength="7" onkeyup="return(DoCheckLength(this));" id="codigo" name="codigo" placeholder="Inserir produto no estoque" style="height: 100px; font-size: 40px;">
                              
</form>
</div>
	
	
</div>




<div class="col-xs-12 col-md-6">
	
	<div class="box">
	<div class="box-header">
		<h3>Últimas entradas no estoque</h3>

	</div>
	
	<table class="table">
	
	<thead>
		<tr>

		<th scope="col">Data</th>
      	<th scope="col">Produto</th>
      	<th scope="col">Checado</th>
      	
      
    </tr>
	</thead>


	<tbody>

	@foreach($itens as $e)
		<tr>
			<td>{{date("d/m/Y",strtotime($e->created_at))}}</td>
			<td>{{$e->produto->nome}}</td>
			<td>{{$e->user->name}}</td>
			
			
		</tr>

	@endforeach
	</tbody>
</table>

</div>
</div>


<div class="col-md-4">
	<div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Produtos em estoque</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
          
<div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Produtos com estoque baixo</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>

</div>








@endsection