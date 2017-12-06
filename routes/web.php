<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/login');
});

Route::get('/admin/painel', 'HomeController@index');



Route::resource('admin/estoque','EstoqueController');

Route::resource('admin/saidaEstoque','EstoqueSaidaController');

Route::resource('admin/vendas','VendaController');




Route::resource('admin/colaber','ColaberController');

Route::get('admin/test','HomeController@listaVendas');








Auth::routes();


Route::resource('admin/api/vendaTemp', 'VendaTempApiController');
Route::get('admin/api/vendaTemp/cancelar' , 'VendaTempApiController@cancelar');

Route::resource('admin/api/estoqueTemp', 'EstoqueApiTempController');


