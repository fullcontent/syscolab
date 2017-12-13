<html>
<link href="{{ asset("vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
 

    <style>
    	
@page {
    size: 21cm 29.7cm;
    margin: 5mm 0mm 20mm 0mm;
    page-break-after : always; /* change the margins as you want them to be. */
}

@media print {

    .col {

        page-break-inside: avoid;
    }

    .etiquetas{
    page-break-after: always;
}
    


}

p {
    font-size: 10px;
    line-height: 10px;
}
h5 {

    font-size: 15px;

}
.page-center{
    text-align: center;
    margin: 0 auto;
}



.col {
position: relative;
  min-height: 1px;
  padding-right: 0px;
  padding-left: 0px;
  float: left;

}

.etiqueta {
    
    padding: 45px 10px 0px;
    border: 1px #666 dotted;
    width: 30mm;
    text-align: center;
    display: block;
}


.produto {

    height: 40px;
    overflow: hidden;
    
}

.marca {

    height: 20px;
    width: 25mm;
    text-align: center;
    overflow: hidden;
}

.atributos {

    height: 10px;
}

.tabela{
    padding: 20px 30px;
    page-break-before: always;
}
.etiquetas{
    page-break-after: always;
}






    </style>
	
	<body onload="print()">
		
		<section class="etiquetas">
		
		<div class="row">
			
			<div class="col-xs-12">
        <h2 class="page-header">
          Remessa #{{$envios->id}} de {{$user->marca}}
          <small class="pull-right">{{ date("d/m/Y",strtotime($envios->created_at)) }}</small>
        </h2>
      </div>

		</div>
		

		
{!! $html !!}



    

		</section>
        
        


	</body>
</html>

