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
use App\Models\Colaber;

use App\Models\Relatorio;

use Input;


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
        // $produtosVendidosGerencia = $this->produtosVendidosGerencia();
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
        $relatorios = $this->relatorios();

        

        switch ($privilege) {
            case 'Colabers':
                
                return view("painel.colaber")->with(
                    [
                        'produtosBaixoEstoque'  =>  $produtosBaixoEstoque,
                        'produtosMaisVendidos' =>   $produtosMaisVendidos,
                        'totalVendas'   =>  $totalVendas,
                        'ultimasNoticias'   =>  $ultimasNoticias,
                        'relatorios'    =>  $relatorios,

                    ]);

                break;
            
            default:
                
                return view("painel.gerencia")
                ->with(
                    [
                        'produtosBaixoEstoqueGerencia'=>$produtosBaixoEstoqueGerencia,
                        'vendas'    =>  $vendas,
                        'produtosVendidosGerencia'  =>  $produtosVendidosGerencia,
                        'produtosMaisVendidosGerencia' => $produtosMaisVendidosGerencia,
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

        $produtos = Produtos::with('colaber')->withCount('saidaEstoque','venda','entradaEstoque')->take(7)->get();

        $estoqueBaixo = $produtos->filter(function($item){
            return $item->estoqueFeira() <= 2;
        });

              
        return $estoqueBaixo;
    }

    public function produtosMaisVendidosGerencia()
    {
        $user_id = CRUDBooster::myId();
        $produtos = Produtos::whereHas('venda')
            ->withCount('venda')
            ->orderBy('venda_count','desc')
            ->take(7)
            ->get();

        return $produtos;
    }

    public function produtosVendidosGerencia()
    {
       

       $produtos = Produtos::whereHas('venda')
            ->with('colaber','venda')
            ->withCount('venda')
            ->orderBy('venda_count','desc')
            ->paginate(15);



        // $ItensVenda = VendasItem::all();

            $ItensVenda = VendasItem::with('produto')->get();

            

        foreach ($ItensVenda as $key => $p) {

        $produto[] = Produtos::whereHas('venda')->with('venda','colaber')->where('id',$p->produto_id)->get();

           foreach ($produto as $p)
           {

                $venda_id = $p[0]['venda'][0]['venda_id'];

           }
            

             $venda[] = Vendas::find($venda_id);

             $produto[$key]['venda']=$venda;

        }
             
       
       return $produto;
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
            ->take(10)
            ->get();

        return $produtos;


    }

    public function produtosBaixoEstoque()
    {   
        
        $user_id = CRUDBooster::myId();

        $produtos = Produtos::where('user_id',$user_id)->withCount('saidaEstoque','venda','entradaEstoque')
        ->take(10)
        ->get();

        

        
        $estoqueBaixo = $produtos->filter(function($item){
            return $item->estoqueFeira() <= 2;
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

        $test = VendasItem::sum('valor');

        

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

    public function relatorios()
    {
        
        $id = CRUDBooster::myId();

        // $id = 44;
        $report = Relatorio::where('colaber_id',$id)->get();


        // dd($report->count());


        if($report)
        {
            return $report;
        }
        

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

    public function listaColabers()
    {
            


            // $colabers = Colaber::with('user')->whereRaw('user.id_cms_privileges',2)->get();

            $colabers = DB::table('colabers')
                            ->join('cms_users','colabers.user_id','=','cms_users.id')
                            ->where('cms_users.id_cms_privileges',2)
                            ->get();


            return view('colabers.lista')->with('colabers',$colabers);

    }


   
    
  
}
