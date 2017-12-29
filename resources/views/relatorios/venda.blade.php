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
                    <h4>Bendita Colab - Loja e Coworking de Artesanato</h4>
                    <span>Rua Prof. Ulisses Vieira, 696 - Curitiba/PR</span>
                    <p>(41) 3532-2045 (41) 99997-8713</p>
                    <p>benditacolab@gmail.com</p>
                </div>
                <div class="col-xs-3">
                    <h3>Relatório de resultados</h3>
                    <h4></h4>
                    <h4></h4>
                </div>


            <div class="row">


                
                <div class="col-xs-12">
                    <h3 class="page-header">
                        {{$colaber->marca}}
                       <span class="pull-right">{{$mes}} de 2017</span>
                    </h3>
                    


                </div>

            </div>

           @if (count($lista) >= 1)
                <table class="table table-responsive table-condensed table-bordered">

                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Código</th>
                        <th width="2">Qtde</th>
                        <th>Produto</th>
                        <th>Valor Unit</th>
                        
                        <th>Valor Liquido</th>
                                            
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach($lista as $key => $l)
                       @foreach($l->venda as $v)
                        <tr>
                            <td>
                                
                                    {{date('d/m/Y', strtotime($v->created_at))}}
                                                    
                            </td>
                            <td>{{$l->codigo}}</td>
                            <td>{{$v->qtde}}</td>
                            <td>{{$l->nome}}</td>
                            <td>R$ {{$l->valor}}</td>
                            
                            <td>R$ {{number_format($l->valor - ($l->valor * $porcentagem/100),2)}}</td>
                        </tr>       
                    @endforeach 
                    @endforeach
                    
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style=""></td>
                        <td><h5 align="right">Subtotal</h5></td>
                        <td><h5>R$ {{number_format($lista->sum('total'),2)}}</h5></td>
                    </tr>
                    <tr>
                        <td colspan="4" class=""></td>
                        <td><h5 align="right">Loja {{$porcentagem}}%</h5></td>
                        <td><h5>R$ {{number_format(($lista->sum('total') * $porcentagem/100),2)}}</h5></td>
                    </tr>
                    <tr>
                        <td colspan="4" class=""></td>
                        <td><h5 align="right">Total</h5></td>
                        <td><h5>R$ {{number_format($lista->sum('total') - ($lista->sum('total') * $porcentagem/100),2)}}</h5></td>
                    </tr>
                </tfoot>
                    
  
            </table>
             <button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
             
                 
            @else
                <div class="callout callout-danger">
                <p>Nenhuma venda encontrada no mês de {{$mes}}</p>

                
              </div>
            @endif

            

           
            <button class="btn btn-success hidden-print" onclick="window.history.go(-1); return false;"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Voltar</button> 
      
    
           



        </div>

        <script>
            function myFunction() {
            window.print();
            }
        </script>

        

@endsection