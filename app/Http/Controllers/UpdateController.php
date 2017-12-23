<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Produtos;
use App\Models\Estoque;
use App\Models\Envio;
use App\Models\EnvioItem;
use App\Models\Vendas;

use App\Models\VendasItem;

class UpdateController extends Controller
{
    



	public function index()
	{
		
		$produtosRemotos = $this->getRemoteProdutos();
    $atualizarProdutosRemotos = $this->atualizarProdutosRemotos();
		$estoqueRemoto = $this->getRemoteEstoque();
		$enviosRemoto = $this->getRemoteEnvios();
    $estoqueLocal = $this->getLocalEstoque();
		$envioItensRemoto = $this->getRemoteEnvioItens();
		$vendas = $this->updateVendas();
    $vendasItens = $this->updateVendasItens();


    


    $vars[] = [

      'enviosRemoto' => $enviosRemoto,
      'produtosRemotos' => $produtosRemotos,
      'atualizarProdutosRemotos' => $atualizarProdutosRemotos,
      'estoqueRemoto' => $estoqueRemoto,
      'estoqueLocal'  => $estoqueLocal,
      'envioItensRemoto' => $envioItensRemoto,
      'vendas'  => $vendas,
      'vendasItens' => $vendasItens

  ];


    return view('atualiza')->with('mensagens',$vars);



	}



    public function getRemoteProdutos()
    {
        
      
     // echo "Verificando se há novos produtos..."; 

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
        return "Nenhum Produto para atualizar!";
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

        // echo "Inserindo produto id: ".$p->id."<br>";

      }
     
        // echo "<h2>Finalizado</h2>";

      return "atualizado ".$produtosFora->count()." itens";

    }


    public function getRemoteEstoque()
    {
        
      
     // echo "Verificando se há novas entradas no estoque..."; 

     $db_ext = DB::connection('mysql_gcloud');
     $externo = $db_ext->table('estoques')->get();
     
     foreach($externo as $p)
     {

        $listaExterno[] = $p->id;

     }


     $interno = Estoque::all();

        foreach ($interno as $i) {
            
            $listaInterno[] = $i->id;
        }


       $compares = array_diff($listaExterno, $listaInterno);

       if(empty($compares))
       {
        // echo "<p>Nenhuma atualizacao de estoque!</p>";
        return "Nenhuma atualizacao de estoque.";
       }


      $estoqueExt = $db_ext->table('estoques')->whereIn('id',$compares)->get();

      foreach ($estoqueExt as $p) {
          

        $entrada = new Estoque;
        $entrada->id = $p->id;
        $entrada->produto_id = $p->produto_id;
        $entrada->user_id = $p->user_id;
        $entrada->operacao = $p->operacao;
        $entrada->qty = $p->qty;
        $entrada->comentarios = $p->comentarios;
        

        $entrada->save();

        // echo "Inserindo estoque id: ".$p->id."<br>";

      }
     
        return "atualizado ".$estoqueExt->count()." itens no estoque";

    }

    public function getLocalEstoque()
    {
        
      
     // echo "Verificando se há novas entradas no estoque..."; 

     $db_ext = DB::connection('mysql_gcloud');
     $externo = Estoque::all();
     
     foreach($externo as $p)
     {

        $listaExterno[] = $p->id;

     }


     $interno = $db_ext->table('estoques')->get();

        foreach ($interno as $i) {
            
            $listaInterno[] = $i->id;
        }


      $compares = array_diff($listaExterno, $listaInterno);

       

       if(empty($compares))
       {
        // echo "<p>Nenhuma atualizacao de estoque!</p>";
        return "Nenhuma atualizacao de estoque local.";
       }


      $estoqueExt = Estoque::whereIn('id', $compares)->get();

      

      foreach ($estoqueExt as $p) {
          

        // $entrada = new Estoque;
        // $entrada->id = $p->id;
        // $entrada->produto_id = $p->produto_id;
        // $entrada->user_id = $p->user_id;
        // $entrada->operacao = $p->operacao;
        // $entrada->qty = $p->qty;
        // $entrada->comentarios = $p->comentarios;
        

        // $entrada->save();

        $entrada = DB::connection('mysql_gcloud')->table('estoques')->insert(

          [
            'id'=> $p->id,
            
            'produto_id' => $p->produto_id,
            'user_id' =>  $p->user_id,
            'operacao' =>  $p->operacao,
            'qty' =>  $p->qty,
            'comentarios' => $p->comentarios



        ]);

        // echo "Inserindo estoque id: ".$p->id."<br>";

      }
     
        return "atualizado ".$estoqueExt->count()." itens no estoque";

    }

    public function getRemoteEnvios()
    {
        
      
    // echo "Verificando se há novas Remessas..."; 

     $db_ext = DB::connection('mysql_gcloud');
     $externo = $db_ext->table('envios')->get();
     
     foreach($externo as $p)
     {

        $listaExterno[] = $p->id;

     }


     $interno = Envio::all();

        foreach ($interno as $i) {
            
            $listaInterno[] = $i->id;
        }


       $compares = array_diff($listaExterno, $listaInterno);

       if(empty($compares))
       {
        // echo "<p>Nenhuma atualizacao de envio!</p>";
        return "Nenhuma atualizacao de envio";
       }


      $envioExt = $db_ext->table('envios')->whereIn('id',$compares)->get();

      foreach ($envioExt as $p) {
          

        $entrada = new Envio;
        $entrada->id = $p->id;
        $entrada->user_id = $p->user_id;
        $entrada->comments = $p->comments;
               

        $entrada->save();

        // echo "Inserindo envio id: ".$p->id."<br>";

      }
     
        return "atualizado ".$envioExt->count()." remessas.";

    }

    public function getRemoteEnvioItens()
    {
      

     // echo "Verificando se há novas itens de remessa..."; 

      
     $db_ext = DB::connection('mysql_gcloud');
     $externo = $db_ext->table('envio_items')->get();
     
     foreach($externo as $p)
     {

        $listaExterno[] = $p->id;

     }


     $interno = EnvioItem::all();

        foreach ($interno as $i) {
            
            $listaInterno[] = $i->id;
        }


       $compares = array_diff($listaExterno, $listaInterno);

       if(empty($compares))
       {
        return "Nenhuma atualizacao de itens de envio!";

       }


      $envioExt = $db_ext->table('envio_items')->whereIn('id',$compares)->get();

      foreach ($envioExt as $p) {
          

        $entrada = new EnvioItem;
        $entrada->id = $p->id;
        $entrada->envio_id = $p->envio_id;
        $entrada->produto_id = $p->produto_id;
        $entrada->qtde = $p->qtde;
        
               

        $entrada->save();

        // echo "Inserindo envio id: ".$p->id."<br>";

      }
     
        return "atualizado ".$envioExt->count()." itens em remessas.";

    }


    public function updateVendas()
    {
    	 

      // echo "Verificando se há novas vendas..."; 


       $listaInterno[]=null;
       $listaExterno[]=null;

    	$vendasInt = Vendas::all();

		      foreach($vendasInt as $i)
		     {

		        $listaInterno[] = $i->id;

		     }

         
		

		$db_ext = DB::connection('mysql_gcloud');
    $vendasExt = $db_ext->table('vendas')->get();


            foreach ($vendasExt as $i) {
            
            $listaExterno[] = $i->id;
        }






    $compareExtInt = array_diff_assoc($listaExterno, $listaInterno);

    $compareIntExt = array_diff_assoc($listaInterno, $listaExterno);


       if(empty($compareIntExt))
       {
        return "Nenhuma atualizacao a receber";
       }

       if(empty($compareExtInt))
       {
        return "Nenhuma atualizacao a enviar";
       }

       


       //$atualizaRemoto = $db_ext->table('vendas')->whereNotIn('id',$compareIntExt)->get();

       $atualizaRemoto = Vendas::whereIn('id',$compareIntExt)->get();

       
       //Inserindo dados no servidor Remoto

       foreach ($atualizaRemoto as $p) {
        $entrada = DB::connection('mysql_gcloud')->table('vendas')->insert(

          [
            'id'=> $p->id,
            'user_id' =>  $p->user_id,
            'tipoPagamento' => $p->tipoPagamento,
            'valorVenda'  =>  $p->valorVenda,
            'valorRecebidoDinheiro' =>  $p->valorRecebidoDinheiro,
            'valorRecebidoDebito' =>  $p->valorRecebidoDebito,
            'valorRecebidoCredito'  =>  $p->valorRecebidoCredito,
            'parcelasCredito' =>  $p->parcelasCredito,
            'desconto'  =>  $p->desconto,
            'localVenda'  =>  $p->localVenda,
            'comentarios' => $p->comentarios



        ]);


        // echo "Inserindo envio id: ".$p->id."<br>";
         
       }

       //----------------------------------------------------------------------------


       $atualizaLocal = $db_ext->table('vendas')->whereIn('id', $compareExtInt)->get();

       foreach ($atualizaLocal as $p) {
          

        $entrada = new Vendas;
        $entrada->id = $p->id;
        $entrada->user_id = $p->user_id;
        $entrada->tipoPagamento = $p->tipoPagamento;
        $entrada->valorVenda = $p->valorVenda;

        $entrada->valorRecebidoDinheiro = $p->valorRecebidoDinheiro;
        $entrada->valorRecebidoDebito = $p->valorRecebidoDebito;
        $entrada->valorRecebidoCredito = $p->valorRecebidoCredito;
        $entrada->parcelasCredito = $p->parcelasCredito;

        $entrada->desconto = $p->desconto;
        $entrada->localVenda = $p->localVenda;
        $entrada->comentarios = $p->comentarios;
        
        $entrada->save();

        // echo "Inserindo envio id: ".$p->id."<br>";

      }
     
      return "<p>atualizado ".$atualizaLocal->count()." Vendas Locais.</p><p>atualizado ".$atualizaRemoto->count()." Vendas Remotas.</p>";
    }



    public function updateVendasItens()
    {
       

      // echo "Verificando se há novas Itens de vendas..."; 


       $listaInterno[]=null;
       $listaExterno[]=null;

      $vendasInt = VendasItem::all();

          foreach($vendasInt as $i)
         {

            $listaInterno[] = $i->id;

         }

         
    

    $db_ext = DB::connection('mysql_gcloud');
    $vendasExt = $db_ext->table('vendas_items')->get();


            foreach ($vendasExt as $i) {
            
            $listaExterno[] = $i->id;
        }






    $compareExtInt = array_diff_assoc($listaExterno, $listaInterno);

    $compareIntExt = array_diff_assoc($listaInterno, $listaExterno);



        if(empty($compareIntExt))
       {
        return "Nenhuma atualizacao a enviar";
       }

       if(empty($compareExtInt))
       {
        return "Nenhuma atualizacao a receber";
       }

       

       


       //$atualizaRemoto = $db_ext->table('vendas')->whereNotIn('id',$compareIntExt)->get();

       $atualizaRemoto = VendasItem::whereIn('id',$compareIntExt)->get();

       
       //Inserindo dados no servidor Remoto

       foreach ($atualizaRemoto as $p) {
        $entrada = DB::connection('mysql_gcloud')->table('vendas_items')->insert(

          [
            'id'=> $p->id,
            'venda_id' =>  $p->venda_id,
            'produto_id' => $p->produto_id,
            'valor'  =>  $p->valor,
            'qtde' =>  $p->qtde,
            'total_venda' =>  $p->total_venda,
            'localVenda'  =>  $p->localVenda,
          ]);


        // echo "Inserindo item id: ".$p->id."<br>";
         
       }

       //----------------------------------------------------------------------------


       $atualizaLocal = $db_ext->table('vendas_items')->whereIn('id', $compareExtInt)->get();

       foreach ($atualizaLocal as $p) {
          

        $entrada = new VendasItem;
        $entrada->id = $p->id;
        $entrada->venda_id = $p->venda_id;
        $entrada->produto_id = $p->produto_id;
        $entrada->valor = $p->valor;

        $entrada->qtde = $p->qtde;
        $entrada->total_venda = $p->total_venda;
        $entrada->localVenda = $p->localVenda;
        
        
        $entrada->save();

        // echo "Inserindo items id: ".$p->id."<br>";

      }
     
      return "<p>atualizado ".$atualizaLocal->count()." Vendas Locais.</p><p>atualizado ".$atualizaRemoto->count()." Vendas Remotas.</p>";
    }


public function atualizarProdutosRemotos()

{
     // echo "Verificando se há novos produtos...<br>"; 


     $fromDT = date("Y-m-d",strtotime("-1 days"));
     $toDT = date("Y-m-d",strtotime("+1 day"));

     $db_ext = DB::connection('mysql_gcloud');
     $externo = $db_ext->table('produtos')
              
                ->whereNotNull('updated_at')
                ->where('updated_at','>',$fromDT)
                ->get();

      

      $ext = $externo->pluck('id','updated_at');
      
      $interno = Produtos::whereIn('id',$ext)->get();
      $int = $interno->pluck('id','updated_at');


      $compares = $int->diffAssoc($ext);


      

      



       if(empty($compares))
       {
        return "Nenhum Produto para atualizar!";
       }


      $produtosFora = $db_ext->table('produtos')->whereIn('id',$compares)->get();


      // dd($produtosFora);

      

      foreach ($produtosFora as $p) {
          


        $entrada = Produtos::where('id',$p->id)
                    ->update([
                      'nome' => $p->nome,
                      'tamanho'=>$p->tamanho,
                      'acabamento'=>$p->acabamento,
                      'descricao'=>$p->descricao,
                      'cor'=>$p->cor,
                      'img'=>$p->img,
                      'updated_at'=>$p->updated_at,
                      'valor'=>$p->valor
                    ]);
        

       // echo "Atualizando produto id: ".$p->id."<br>";

      }
     
        // echo "<h2>Finalizado</h2>";

      return "atualizado ".$produtosFora->count()." itens";



}




}
