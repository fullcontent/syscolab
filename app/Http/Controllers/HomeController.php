<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Auth;
use App;
use PDF;
use App\User;
use CRUDBooster;
use DB;
use Response;

use DNS1D;
use App\Models\Vendas;
use App\Models\VendasItem;
use App\Models\Produtos;

use App\Models\Estoque;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $user_id = CRUDBooster::myId();

        
        $numProdutos = DB::table('produtos')->where('user_id',$user)->count();
        $numUsuarios = DB::table('cms_users')->where('id_cms_privileges',2)->count();

        return view('painel')->with(['numUsuarios'=>$numUsuarios,'numProdutos'=>$numProdutos]);

    }


    public function listaVendas()
    {

        $user_id = 1;
        $vendas = Produtos::where('user_id',$user_id)->whereHas('venda')->withCount('entradaEstoque','saidaEstoque','venda')->get();

        foreach ($vendas as $v){

            $totalVendas = VendasItem::where(['produto_id'=>$v->id])->sum('total_venda');
        }


        return Response::json($vendas);
    }

   

  
}
