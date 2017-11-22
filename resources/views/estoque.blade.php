@extends('crudbooster::admin_template')
@section('content')

<script language="javascript">




    function DoCheckLength(aTextBox) { 
      if (aTextBox.maxLength - aTextBox.value.length==0) { 
         document.theForm.submit(); 
        //beep.play(); 
      } 
    } 
    document.getElementById("codigo").focus();


  </script>


<h1>{{$message}}</h1>

<div class="col-xs-12">

<div class="box">
	
	<form class="form-horizontal style-form" name="theForm" action="" method="post">

		 {{ csrf_field() }}

       <input class="form-control" type="text" autofocus="" maxlength="7" onkeyup="return(DoCheckLength(this));" id="codigo" name="codigo" placeholder="Digitalize o codigo de barras">
                              
</form>
</div>
	
	
</div>


<div class="col-xs-12">
	
	<div class="box">
	<div class="box-header">
		<h4>Ultimas entradas no estoque</h4>

	</div>
	
	<table class="table">
	
	<thead>
		<tr>
      	<th scope="col">#</th>
      	<th scope="col">Recebido por:</th>
      	<th scope="col">Produto</th>
      <th scope="col">Mensagem</th>
    </tr>
	</thead>


	<tbody>

	@foreach($itens as $e)
		<tr>
			<th scope="row">{{$e->id}}</th>
			<td>{{$e->user->name}}</td>
			<td>{{$e->produto->nome}}</td>
			<td>{{$e->remarks}}</td>
		</tr>

	@endforeach
	</tbody>
</table>

</div>
</div>








@endsection