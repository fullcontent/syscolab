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


		$produtos = Produtos::withCount('EntradaEstoqueCasa','EntradaEstoqueFeira','SaidaEstoqueCasa','SaidaEstoqueFeira','VendasCasa','VendasFeira')->get();
		

		$produtos2 = Produtos::with('envios')->where('codigo','0009988')->first();
	

		$envio = EnvioItem::whereHas('envio' , function($query){

			$query->where('tipoEnvio', 'Feira');
		})->where('produto_id',$produtos2->id)->get();		

		




		return view('produtos.lista')->with('produtos',$produtos);

	}

}