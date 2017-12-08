@extends('crudbooster::admin_template')
@section('content')



{!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
{!! Html::script('js/venda.js', array('type' => 'text/javascript')) !!}

<div class="container-fluid" ng-app="syscolab" ng-controller="vendaCtrl">



<div class="col-xs-12">

<div class="box">
	
 

<form ng-submit="adicionarVendaTemp(codigo)" name="scanCode">


	<input class="form-control" type="text" id="codigo" name="codigo" placeholder="código" style="height: 100px; font-size: 90px;" ng-model="codigo" autocomplete="off" required>
</form>

                            

</div>
	
	
</div>

{!! Form::open(array('url' => 'admin/vendas', 'class' => 'form-horizontal')) !!}

<table class="table table-bordered">
                            <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Produto</th>
                            <th>Valor</th>
                            <th>Qtde.</th>
                            <th>Total</th>
                            <th>&nbsp;</th>
                        	</tr>

                            <tr ng-repeat="novaVendaTemp in vendaTemp | orderBy: '-id'">
                            <td>@{{$index+1}}</td>
                            <td>@{{novaVendaTemp.item.codigo}}</td>
                            <td>@{{novaVendaTemp.item.nome}}</td>
                            <td>@{{novaVendaTemp.valor | currency}}</td>	
                            <td><input type="text" style="text-align:center" autocomplete="off" name="quantity" ng-change="atualizaVendaTemp(novaVendaTemp)" ng-model="novaVendaTemp.qtde" size="2" disabled></td>
                            <td>@{{novaVendaTemp.valor * novaVendaTemp.qtde | currency}}</td>
                            <td><button class="btn btn-danger btn-xs" type="button" ng-click="removeVendaTemp(novaVendaTemp.id)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
                            </tr>
                        </table>


							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total" class="col-sm-4 control-label">Recebimento</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input type="text" class="form-control" id="valorRecebido" ng-model="add_payment" name="valorRecebido" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total" class="col-sm-4 control-label">Desconto</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input type="text" class="form-control" id="desconto" ng-model="desconto" name="desconto" value="0" />
                                            </div>
                                        </div>
                                    </div>


                                    
                                    <div>&nbsp;</div>
                                    <div class="form-group">
                                        <label for="employee" class="col-sm-4 control-label">Pagamento</label>
                                        <div class="col-sm-8">
                                        <select name="tipoPagamento" class="form-control">
                                        	<option value="Debito">Debito</option>
                                        	<option value="Credito">Credito</option>
                                        	<option value="Dinheiro">Dinheiro</option>

                                        </select>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supplier_id" class="col-sm-4 control-label">Total</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static"><b>@{{sum(vendaTemp) | currency}}</b></p>
                                            <input type="hidden" name="valorVenda" value="@{{sum(vendaTemp)}}"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="amount_due" class="col-sm-4 control-label">Troco</label>
                                            <div class="col-sm-8">
                                            <p class="form-control-static">@{{add_payment - (sum(vendaTemp)-desconto) | currency}}</p>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="employee" class="col-sm-4 control-label">Observacoes</label>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" name="comentarios" id="comments" />
                                        </div>
                                    </div>

                                    <div>&nbsp;</div>
                                    
                                    <div>&nbsp;</div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success btn-block">Fechar Venda</button>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                            {!! Form::close() !!}

</div>


@endsection