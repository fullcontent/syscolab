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
    return view('home');
});

Route::get('vendas', 'HomeController@index');


Route::any('cadastra', function() {

	


	if (Request::ajax()) 
   {
      return Response::json($dados);
   }		

});



Auth::routes();



