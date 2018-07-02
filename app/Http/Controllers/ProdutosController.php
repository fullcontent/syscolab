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
   use Cache;


class ProdutosController extends Controller
{


	public function index()
	{


		

		if(!Cache::has('produtos')){

			
			$produtos = Produtos::withCount('EntradaEstoqueCasa','EntradaEstoqueFeira','SaidaEstoqueCasa','SaidaEstoqueFeira','VendasCasa','VendasFeira')->get();

		Cache::put('produtos', $produtos, 1);
			


		}

		else{

			$produtos = Cache::get('produtos');

		}


		


		return view('produtos.lista')->with('produtos',$produtos);

	}

}