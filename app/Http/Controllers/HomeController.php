<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Auth;
use App;
use App\User;
use CRUDBooster;

use Response;


use App\Models\Vendas;
use App\Models\VendasItem;
use App\Models\Produtos;

use App\Models\Estoque;
use App\Models\UltimasNoticias;




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


        $privilege = CRUDBooster::myPrivilegeName();
       
        //Metodos de Gerencia

        $produtosBaixoEstoqueGerencia = $this->produtosBaixoEstoqueGerencia();
        $produtosMaisVendidosGerencia = $this->produtosMaisVendidosGerencia();
        $vendas = $this->listaVendas();
        $totalVendasDiarioGerencia = $this->totalVendasDiarioGerencia();
        $totalVendasSemanalGerencia = $this->totalVendasSemanalGerencia();
        $numTotalVendas = $this->numTotalVendas();
        $ticketMedioGerencia = $this->ticketMedioGerencia();

        //------------------------------------

        //Metodos Colabers
        
        $produtosBaixoEstoque = $this->produtosBaixoEstoque();
        $produtosMaisVendidos = $this->produtosMaisVendidos();
        $totalVendas = $this->totalVendas();
        $ultimasNoticias = $this->ultimasNoticias();

        

        switch ($privilege) {
            case 'Colabers':
                
                return view("painel.colaber")->with(
                    [
                        'produtosBaixoEstoque'  =>  $produtosBaixoEstoque,
                        'produtosMaisVendidos' =>   $produtosMaisVendidos,
                        'totalVendas'   =>  $totalVendas,
                        'ultimasNoticias'   =>  $ultimasNoticias,

                    ]);

                break;
            
            default:
                
                return view("painel.gerencia")
                ->with(
                    [
                        'produtosBaixoEstoqueGerencia'=>$produtosBaixoEstoqueGerencia,
                        'vendas'    =>  $vendas,
                        'produtosMaisVendidosGerencia'  =>  $produtosMaisVendidosGerencia,
                        'totalVendasDiarioGerencia' =>  $totalVendasDiarioGerencia,
                        'totalVendasSemanalGerencia'    =>  $totalVendasSemanalGerencia,
                        'numTotalVendas'    =>  $numTotalVendas,
                        'ticketMedioGerencia'   =>  $ticketMedioGerencia,


                    ]);

                break;
        }
    }


    


    //Metodos para dados da Gerencia -------------------------------------------------------

    public function listaVendas()
    {

        $vendas = Vendas::with('user')->orderBy('created_at','desc')->take(8)->get();

        return $vendas;

    }


    public function totalVendasDiarioGerencia()
    {
        $today = date('Y-m-d');
        $vendas = Vendas::whereDate('created_at',$today)->sum('valorVenda');

        return $vendas;


    }

    public function totalVendasSemanalGerencia()
    {

        $fromDT = date("Y-m-d",strtotime("-5 days"));
        $toDT = date("Y-m-d",strtotime("+1 day"));

        $vendas = Vendas::whereBetween('created_at',[$fromDT, $toDT])->sum('valorVenda');

        return $vendas;
    }

    public function numTotalVendas()
    {

        $vendas = Vendas::count();

        return $vendas;

    }

    public function ticketMedioGerencia()
    {

        $vendas = Vendas::avg('valorVenda');

        return $vendas;

    }

    public function produtosBaixoEstoqueGerencia()
    {   
        
        $user_id = CRUDBooster::myId();

        $produtos = Produtos::with('colaber')->withCount('saidaEstoque','venda','entradaEstoque')->get();

        $estoqueBaixo = $produtos->filter(function($item){
            return $item->estoque() <= 3;
        });

        
        return $estoqueBaixo;
    }

    public function produtosMaisVendidosGerencia()
    {
       $produtos = Produtos::whereHas('venda')
            ->with('colaber')
            ->withCount('venda')
            ->orderBy('venda_count','desc')
            ->get();
        return $produtos;
    }

    public function estoqueCasa()
    {
        $produtos = Produtos::
                    select('nome','colabers.marca','cms_users.name')
                    ->join('cms_users','produtos.user_id','cms_users.id')
                    ->join('colabers','produtos.user_id','colabers.id')
                    ->withCount('EntradaEstoqueCasa','SaidaEstoqueCasa','vendasCasa')
                    ->get();
        $estoqueBaixo = $produtos->filter(function($item){
            return $item->estoqueCasa() <= 3;
        });



        return $estoqueBaixo;
    }



    //FIM dos Metodos para dados da Gerencia -------------------------------------------------------


    //Metodos para dados do Colaborador 


    public function produtosMaisVendidos()
    {
        $user_id = CRUDBooster::myId();
        $produtos = Produtos::where('user_id',$user_id)
            ->whereHas('venda')
            ->withCount('venda')
            ->orderBy('venda_count','desc')
            ->get();

        return $produtos;


    }

    public function produtosBaixoEstoque()
    {   
        
        $user_id = CRUDBooster::myId();

        $produtos = Produtos::where('user_id',$user_id)->withCount('saidaEstoque','venda','entradaEstoque')->get();

        $estoqueBaixo = $produtos->filter(function($item){
            return $item->estoque() <= 2;
        });
     
        return $estoqueBaixo;
    }
   
    

    public function totalVendas()
    {
        $user_id = CRUDBooster::myId();

        if($user_id==1){

            $produtos = Produtos::whereHas('venda')
            ->withCount('venda')
            ->get();

        }else{

        $produtos = Produtos::where('user_id',$user_id)
            ->whereHas('venda')
            ->withCount('venda')
            ->get();
        }

        $total[] = 1;
        foreach($produtos as $p)
        {
            $total[] = VendasItem::where('produto_id',$p->id)->sum('valor');

        }

        $sub = array_sum($total);
        $sub = number_format($sub,2);   
        
        return $sub;

    }

    public function ultimasNoticias()
    {
        $noticias = UltimasNoticias::orderBy('created_at','desc')->get();
        return $noticias;
    }


  
}
