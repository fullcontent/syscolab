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

Route::get('/admin/test','HomeController@test');

Route::get('/admin/codigos/{qtde}','HomeController@novosCodigos');


Route::get('/admin/atualiza','UpdateController@index');



Route::get('/admin/vendas','VendasController@index')->name('vendas');
Route::get('/admin/vendas/{id}','VendasController@listaProdutos');
Route::get('/admin/vendas/delete/{id}','VendasController@delete');





Route::get('/admin/ajuda','HomeController@ajuda');



Route::resource('admin/estoqueCasa','EstoqueEntradaCasaController');
Route::resource('admin/estoqueSaidaCasa','EstoqueSaidaCasaController');


Route::resource('admin/estoqueFeira','EstoqueEntradaFeiraController');
Route::resource('admin/estoqueSaidaFeira','EstoqueSaidaFeiraController');





Route::resource('admin/vendasCasa','VendaCasaController');
Route::resource('admin/vendasFeira','VendaFeiraController');


Route::resource('admin/noticias','UltimasNoticiasController');


Route::resource('admin/colaber','ColaberController');









Auth::routes();


Route::resource('admin/api/vendaTemp', 'VendaTempApiController');

Route::get('admin/api/vendaTemp/cancelar' , 'VendaTempApiController@cancelar');

Route::resource('admin/api/estoqueTemp', 'EstoqueApiTempController');


