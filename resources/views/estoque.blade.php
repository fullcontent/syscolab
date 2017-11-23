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
<div class="container-fluid">
	


<h2>{{$message}}</h2>


<div class="col-xs-12">

<div class="box">
	
	<form class="form-horizontal style-form" name="theForm" action="" method="post">

		 {{ csrf_field() }}

       <input class="form-control" type="text" autofocus="" maxlength="7" onkeyup="return(DoCheckLength(this));" id="codigo" name="codigo" placeholder="código" style="height: 100px; font-size: 90px;">
                              
</form>
</div>
	
	
</div>


<div class="col-xs-12 col-md-4">
	
	<div class="box">
	<div class="box-header">
		<h3>Ultimas entradas no estoque</h3>

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
			<td>{{date("d/m/Y",strtotime($e->produto->created_at))}}</td>
			<td>{{$e->produto->nome}}</td>
			<td>{{$e->user->name}}</td>
			
			
		</tr>

	@endforeach
	</tbody>
</table>

</div>
</div>









@endsection