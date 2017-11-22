<html>
<link href="{{ asset("vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{asset("vendor/crudbooster/assets/adminlte/font-awesome/css")}}/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset("vendor/crudbooster/ionic/css/ionicons.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />    
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />

    <style>
    	
    	@page {
    size: 29.7cm 21cm;
    margin: 5mm 10mm 30mm 10mm;
    page-break-after : always; /* change the margins as you want them to be. */
}
    </style>
	
	<body onload="print()">
		
		<section class="etiquetas">
		
		<div class="row">
			
			<div class="col-xs-12">
        <h2 class="page-header">
          Remessa #{{$envios->id}} de {{$user->name}}
          <small class="pull-right">{{ date("d/m/Y",strtotime($envios->created_at)) }}</small>
        </h2>
      </div>

		</div>
		

		
{!! $html !!}





		</section>

		




	</body>
</html>

