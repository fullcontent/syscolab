<html>
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
}



.tabela{
    padding: 0px 30px;
    page-break-before: always;
}



</style>

<body onload="print()">

<div class="tabela">
                


                <div class="col-xs-2">
                    <img src="{{asset('vendor/crudbooster/avatar.jpg')}}" alt="" width="200">
                </div>

                <div class="col-xs-8">
                    <h4>Bendita Colab - Loja e Coworking de Artesanato</h4>
                    <span>Rua Prof. Ulisses Vieira, 696 - Curitiba/PR</span>
                    <p>(41) 3532-2045 (41) 99997-8713</p>
                    <p>benditacolab@gmail.com</p>
                </div>


            <div class="row">


                
                <div class="col-xs-12">
                    <h4 class="page-header">
                        Relatório de entrega de produtos de {{$user->marca}}
                        <small class="pull-right">{{ date("d/m/Y")}}</small>

                    </h4>
                </div>

            </div>
            <table class="table table-condensed table-bordered">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Qtde</th>
                        <th>Nome</th>
                        <th>Cor</th>
                        <th>Tamanho</th>
                        <th>Valor</th>
                        <th width="2">Checado</th>
                        
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
                        <td>{{$i->produto->tamanho}}</td>
                        
                        <td>R$ {{$i->produto->valor}}</td>
                        <td></td>
                    </tr>
                     @endforeach
                </tbody>

  
            </table>

           

                

           



        </div>

        </html>