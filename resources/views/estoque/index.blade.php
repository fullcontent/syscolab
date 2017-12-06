@extends('crudbooster::admin_template')
@section('content')


{!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
{!! Html::script('js/estoque.js', array('type' => 'text/javascript')) !!}


<div class="container-fluid" ng-app="syscolab" ng-controller="estoqueCtrl">


<div class="col-xs-12">

<div class="box">
	
 

<form ng-submit="adicionarEstoqueTemp(codigo)" name="scanCode">
	

	<input class="form-control" type="text" id="codigo" name="codigo" placeholder="Entrada de itens no estoque" style="height: 100px; font-size: 40px;" ng-model="codigo" autocomplete="off">
    
</form>

                            

</div>
	
	
</div>




<div class="col-sm-12">
	

{!! Form::open(array('url' => 'admin/estoque', 'class' => 'form-horizontal')) !!}
<table class="table table-bordered">
                            <tr>
                            <th>#</th>
                            <th>Qtde.</th>
                            <th>Codigo</th>
                            <th>Produto</th>
                            <th>&nbsp;</th>
                        	</tr>

                            <tr ng-repeat="novoEstoqueTemp in estoqueTemp | orderBy: '-id'">
                            <td>@{{$index+1}}</td>
                            <td><input type="text" style="text-align:center" autocomplete="off" name="qtde" ng-change="atualizaEstoqueTemp(novoEstoqueTemp)" ng-model="novoEstoqueTemp.qty" size="2" disabled></td>
                            <td>@{{novoEstoqueTemp.produto.codigo}}</td>
                            
                            <td>@{{novoEstoqueTemp.produto.nome}}</td>
                            
                            <td><button class="btn btn-danger btn-xs" type="button" ng-click="removeEstoqueTemp(novoEstoqueTemp.id)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
                            </tr>
                        </table>
						
						
						
                       	<div class="form-group">
	                        <div class="col-sm-4">
	                        	<h3>Quantidade de itens: @{{sum(estoqueTemp)}} itens</h3>
	                        <button type="submit" class="btn btn-success btn-block">Confirmar Entrada</button>
	                        </div>
                                    
                        </div>
{!! Form::close() !!}


</div>
</div>

@endsection