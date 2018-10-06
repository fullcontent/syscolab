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

Route::get('/admin/painel', 'HomeController@index')->name('painel');


Route::get('/admin/codigos/{qtde}','HomeController@novosCodigos');



Route::get('/admin/vendas','VendasController@index')->name('vendas');



Route::get('/admin/vendas/feira','VendasController@listaVendasFeira')->name('vendasFeira');
Route::get('/admin/vendas/casa','VendasController@listaVendasCasa')->name('vendasCasa');




Route::get('/admin/vendas/{id}','VendasController@listaProdutos')->name('venda');
Route::get('/admin/vendas/delete/{id}','VendasController@delete')->name('delete.venda');
Route::get('/admin/vendas/estornar/{id}/{venda_id}','VendasController@estornar')->name('estornar.venda');



Route::post('/admin/relatorio','RelatoriosController@gerarRelatorio');
Route::get('/admin/relatorios','RelatoriosController@index')->name('relatorios');
Route::get('/admin/relatorio/delete/{id}','RelatoriosController@delete');

Route::post('/admin/relatorio/view/','RelatoriosController@verRelatorio')->name('verRelatorio');

Route::get('/admin/relatorio/ativar/{id}','RelatoriosController@ativarRelatorio');
Route::get('/admin/relatorio/desativar/{id}','RelatoriosController@desativarRelatorio');

Route::get('/admin/relatorio/{id}','RelatoriosController@verPdf');


Route::get('/admin/relatorioVendas','RelatoriosController@relatorioVendas');




Route::post('/admin/relatorioCompleto','RelatoriosController@relatorioCompleto')->name('relatorioCompleto');


Route::get('/admin/ajuda','HomeController@ajuda');

Route::resource('admin/estoqueCasa','EstoqueEntradaCasaController');
Route::resource('admin/estoqueSaidaCasa','EstoqueSaidaCasaController');


Route::resource('admin/estoqueFeira','EstoqueEntradaFeiraController');
Route::resource('admin/estoqueSaidaFeira','EstoqueSaidaFeiraController');


Route::resource('admin/vendasCasa','VendaCasaController');
Route::resource('admin/vendasFeira','VendaFeiraController');


Route::resource('admin/noticias','UltimasNoticiasController');


Route::resource('admin/colaber','ColaberController');


Route::get('admin/colabers','HomeController@listaColabers')->name('colabers');



Route::get('admin/produtos2', 'ProdutosController@index')->name('listaProdutos');





// TEstes

// Route::get('admin/notificationTest/{produto_id}', 'VendaCasaController@sendNotificationToColaber');



Auth::routes();


Route::resource('admin/api/vendaTemp', 'VendaTempApiController');

Route::get('admin/api/vendaTemp/cancelar' , 'VendaTempApiController@cancelar');

Route::resource('admin/api/estoqueTemp', 'EstoqueApiTempController');


