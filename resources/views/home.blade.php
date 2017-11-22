@extends("crudbooster::admin_template")
@section("content")



<h1>Envios</h1>



@foreach ($envios as $envio)

	
	<h3>{{$envio->created_at}}</h3>

	
	<?php

			dd($envios);

			foreach ($itens as $item) {
				
				echo $item->qtde;
			}


			

	?>



@endforeach
      






    

@endsection