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
	
	<body onload="">
		
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
        
        
        <div class="tabela">
                
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        Relatório de entrega de produtos de {{$user->name}}
                        <small class="pull-right">{{ date("d/m/Y",strtotime($envios->created_at)) }}</small>

                    </h2>
                </div>

            </div>
            <table class="table table-responsive table-bordered">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Qtde</th>
                        <th>Nome</th>
                        <th>Cor</th>
                        <th>Valor</th>
                        
                    </tr>
                </thead>

                <tbody>

                     @foreach($itens as $i)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$i->produto->codigo}}</td>
                        <td>{{$i->qtde}}</td>
                        <td>{{$i->produto->nome}}</td>
                        <td>{{$i->produto->cor}}</td>
                        
                        <td>R$ {{$i->produto->valor}}</td>
                    </tr>
                     @endforeach
                </tbody>

  
            </table>

           

                

           



        </div>

		




	</body>
</html>

