<?php

namespace App\Http\Controllers;


	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use DNS1D;
    use App\Models\Produtos;
    use App;
    use App\Models\Estoque;
   use App\Models\EnvioItem;


class ProdutosController extends Controller
{

	public function index()
	{


		$produtos = Produtos::withCount('EntradaEstoqueCasa','EntradaEstoqueFeira','SaidaEstoqueCasa','SaidaEstoqueFeira')->take(20)->get();


		



		return view('produtos.lista')->with('produtos',$produtos);

	}

}