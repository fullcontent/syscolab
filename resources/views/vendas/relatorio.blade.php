@extends("crudbooster::admin_template")
@section("content")


<link href="{{ asset("vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
 

<style>


        
@page {
    size: 29.7cm 21cm;
    margin: 5mm 0mm 5mm 0mm;
    page-break-after : always; /* change the margins as you want them to be. */
    font-size: 8pt;
}

@media print {

    .tabela table{
        font-size: 10px;
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



<div class="tabela">
                


                <div class="col-xs-2">
                    <img src="{{asset('vendor/crudbooster/avatar.jpg')}}" alt="" width="200">
                </div>

                <div class="col-xs-5">
                    
                </div>
                <button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
                


            <div class="row">
              
                <div class="col-xs-12">
                    <h3 class="page-header">
                       Relatorio de Vendas
                    </h3>
                    


                </div>

            </div>

          
                <table class="table table-condensed table-sm">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Pagamento</th>
                                            
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach($lista as $key => $l)
                        
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{date('d/m/Y', strtotime($l->created_at))}}</td>
                            <td>R$ {{$l->valorVenda}}</td>
                            <td>{{$l->tipoPagamento}}</td>
                        </tr>

                            

                    @endforeach
                    
                </tbody>

                 
            </table>
             <button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
            
            <button class="btn btn-success hidden-print" onclick="window.history.go(-1); return false;"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Voltar</button> 
      
    
           



        </div>

        <script>
            function myFunction() {
            window.print();
            }
        </script>

        

@endsection