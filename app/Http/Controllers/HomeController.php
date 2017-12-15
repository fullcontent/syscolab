<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Auth;
use App;
use App\User;
use CRUDBooster;
use DB;

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
        $ultimaNoticiaGerencia = $this->ultimaNoticiaGerencia();
        $estoqueFeira = $this->estoqueFeira();


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
                        'ultimaNoticiaGerencia' => $ultimaNoticiaGerencia,
                        'estoqueFeira' => $estoqueFeira,


                    ]);

                break;
        }
    }


    


    //Metodos para dados da Gerencia -------------------------------------------------------

    public function listaVendas()
    {

        $vendas = Vendas::with('user')->orderBy('created_at','desc')->take(10)->get();

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

        $produtos = Produtos::with('colaber')->withCount('saidaEstoque','venda','entradaEstoque')->take(5)->get();

        $estoqueBaixo = $produtos->filter(function($item){
            return $item->estoque() <= 2;
        });

        
        return $estoqueBaixo;
    }

    public function produtosMaisVendidosGerencia()
    {
       $produtos = Produtos::whereHas('venda')
            ->with('colaber')
            ->withCount('venda')
            ->orderBy('venda_count','desc')
            ->take(5)
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

    public function estoqueFeira()
    {
        $produtos = Produtos::with('colaber')->withCount('EntradaEstoqueFeira')->whereHas('EntradaEstoqueFeira')->paginate(5);
       
        return $produtos;

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

        $sub = array_sum($total)-1;
        $sub = number_format($sub,2);   
        
        return $sub;

    }

    public function ultimasNoticias()
    {
        $noticias = UltimasNoticias::orderBy('created_at','desc')->get();
        return $noticias;
    }

    public function ultimaNoticiaGerencia()
    {
        $noticia = UltimasNoticias::orderBy('id','desc')->first();
        return $noticia;
    }


    public function ajuda()
    {

        return view('ajuda');
    }


    public function verificaCodigosDuplicados()
    {




    

    $produtos = Produtos::with('colaber')->withCount('EntradaEstoqueFeira')->whereHas('EntradaEstoqueFeira')->get();


    foreach($produtos as $p)
    {

        $users[] = $p->user_id;

    }


    

    $duplicates = DB::table('produtos')
    ->select('codigo')
    
    ->groupBy('codigo')
   
    ->havingRaw('COUNT(codigo) > 1')
    ->get();





        foreach($duplicates as $d)
        {

           $produto[] = Produtos::where(['codigo'=>$d->codigo])->whereNotIn('user_id', [39,41,46,50,54])->first();
                       

        }


        foreach($produto as $p)

        {


            $codigo = $this->codigo();

            $prod = Produtos::where('id',$p->id)
                    ->update(['codigo'=>$this->codigo()]);

            echo "<p>Velho ".$prod->codigo." <span>Novo: ".$codigo."</span></p>";

        }

     


        return view('painel')->with('produto',$produto);
    // // return $this->codigo();
        


    }



    public function test()
    {
        
      
     $db_ext = DB::connection('mysql_gcloud');
     $externo = $db_ext->table('produtos')->get();
     
     foreach($externo as $p)
     {

        $listaExterno[] = $p->id;

     }


     $interno = Produtos::all();

        foreach ($interno as $i) {
            
            $listaInterno[] = $i->id;
        }


       $compares = array_diff($listaExterno, $listaInterno);

       if(empty($compares))
       {
        echo "nenhum produto para atualizar";
       }


      $produtosFora = $db_ext->table('produtos')->whereIn('id',$compares)->get();

      foreach ($produtosFora as $p) {
          

        $entrada = new Produtos;
        $entrada->id = $p->id;
        $entrada->nome = $p->nome;
        $entrada->codigo = $p->codigo;
        $entrada->valor = $p->valor;
        $entrada->categoria_id = $p->categoria_id;
        $entrada->tamanho = $p->tamanho;
        $entrada->acabamento = $p->acabamento;
        $entrada->descricao = $p->descricao;
        $entrada->cor = $p->cor;
        $entrada->user_id = $p->user_id;

        $entrada->save();

        echo "Inserindo produto id: ".$p->id."<br>";

      }
     

        echo "<h1>Finalizado</h1>";






    }

    public function novosCodigos($qtde)
    {



        
        for($i=0; $i<$qtde;$i++)
        {
            echo "<h1>".$this->codigo()."</h1>";
        }

        

    }

    public function codigo()
    {



                            
            $exists = 1;


            while($exists > 0){

                $unique_code = mt_rand(0000, 9999); // better than rand()
                $unique_code = str_pad($unique_code, 7, "0", STR_PAD_LEFT);
                $exists = Produtos::where('codigo', $unique_code)->count();

                
                return $unique_code;
            }

            
    }
  
}
