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
    size: 21cm 29.7cm;
    margin: 5mm 0mm 20mm 0mm;
    page-break-after : always; /* change the margins as you want them to be. */
}

@media print {

    footer {page-break-after: always;}
}

p {
    font-size: 10px;
    line-height: 10px;
}
h5 {

    font-size: 15px;

}

.etiqueta {
    
    padding: 45px 25px 0px;
    border: 1px #666 dotted;
    width: 30mm;
    

}

.produto {

    height: 35px;
    overflow: hidden;
    
}
.tabela{
    padding: 20px 30px;
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
        <footer></footer>

        <section class="tabela">
                
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
                        <th scope="row">{{$i->id}}</th>
                        <td>{{$i->produto->codigo}}</td>
                        <td>{{$i->qtde}}</td>
                        <td>{{$i->produto->nome}}</td>
                        <td>{{$i->produto->cor}}</td>
                        
                        <td>R$ {{$i->produto->valor}}</td>
                    </tr>
                     @endforeach
                </tbody>

  
            </table>

           

                

           



        </section>

		




	</body>
</html>

