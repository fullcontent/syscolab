@extends("crudbooster::admin_template")
@section("content")


<link href="{{ asset("vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
 

<style>


        
@page {
    size: 21cm 29.7cm;
    margin: 5mm 0mm 5mm 0mm;
    page-break-after : always; /* change the margins as you want them to be. */
    font-size: 8pt;
}

@media print {

    .tabela table{
        font-size: 10px;
    }
    .panel{

    page-break-inside: avoid;
    }

    .container-fluid{
        display: none;
    }

    footer {

        display: none;
    }
}


.tabela{
    padding: 0px 30px;
    page-break-before: always;
    background: #FFF;
}




</style>


<div class="container-fluid">
    <div class="page-header">
       <h1>Relatorio</h1> 
    </div>
    
    <h4><b>Período:</b> {{$periodo}}</h4>
    <h4><b>Total de vendas:</b> {{$vendas->count()}}</h4>
    <h4><b>Valor total:</b> R$ {{number_format($vendas->sum('valorVenda'),2)}}</h4>


      <button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir relatório</button>
        
        <button class="btn btn-warning hidden-print" onclick="show()"><span class="glyphicon glyphicon-view" aria-hidden="true"></span> Visualizar</button>

       

      <button class="btn btn-success hidden-print" onclick="window.history.go(-1); return false;"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Voltar</button> 
  

</div>





<div class="tabela hidden" id="tabela">
                


                <div class="col-xs-2">
                    <img src="{{asset('vendor/crudbooster/avatar.jpg')}}" alt="" width="100">
                </div>

                <div class="col-xs-5">
                   <h2 class="page-header">
                       Relatorio de Vendas
                    </h2>


                </div>
                
                


            <div class="row">
              
                <div class="col-xs-12">
                    
                     <h4>Periodo: {{$periodo}}</h4>
                     <h4>Total: R$ {{number_format($vendas->sum('valorVenda'),2)}}</h4>


                </div>

            </div>

          
               
				
				<table class="table table-responsive table-condensed">

                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Marca</th>
                        <th>Produto</th>
                        <th>Codigo</th>
                        <th>Qtd</th>
                        <th>Valor</th>
                        <th>Pagamento</th>                                    
                    </tr>
                </thead>

					<tbody> @foreach($vendas as $key => $v)
							@foreach($vendas[$key]['itens'] as $key => $l)
						<tr>
							<td>{{date('d/m/Y',strtotime($v->created_at))}}</td>
							<td>{{$l['produto'][0]['colaber']['marca']}}</td>
							<td>{{$l['produto'][0]['nome']}}</td>
							<td>{{$l['produto'][0]['codigo']}}</td>
							<td>1</td>
							<td>R$ {{$l['produto'][0]['valor']}}</td>
                            <td>{{$v->tipoPagamento}}</td>
						</tr>
							@endforeach
                            @endforeach

					</tbody>

                <tfoot>
                    
                   
              
                

                </tfoot>

                </table>
                
                <div class="col-xs-12">
                    
                     <h4>Periodo: {{$periodo}}</h4>
                     <h4>Total: R$ {{number_format($vendas->sum('valorVenda'),2)}}</h4>

                </div>

				


             <button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
            
            <button class="btn btn-success hidden-print" onclick="window.history.go(-1); return false;"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Voltar</button> 
      
    
           



        </div>

        <script>
            function myFunction() {

          	$( "#tabela" ).removeClass( "hidden" );
            window.print();
            hide();

            }

            function hide()
            {
            	$("#tabela").addClass("hidden");
            }

            function show()
            {
                $("#tabela").removeClass("hidden");
            }
        </script>

        

@endsection