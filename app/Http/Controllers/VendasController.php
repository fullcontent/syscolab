<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Vendas;
use App\Models\VendasItem;
use App\Models\Produtos;
use App\Models\Estoque;
use CRUDBooster;



class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retorna todas as vendas com seus produtos!


        $vendas = $this->listaVendas();
   
     
        return view('vendas.listaVendas')->with(['vendas'=>$vendas]);
       
    }



    public function listaProdutos($id='')
    {


        $venda = Vendas::find($id);

        $lista = VendasItem::with('produto')->where('venda_id',$id)->get();

        // $est = VendasItem::whereHas('estorno')->get();

        // $lista = VendasItem::with('produto')->withCount('estorno')->where()->get();

        
       

         // return $lista;

        return view('vendas.detalheVenda')->with(['venda'=>$venda,'lista'=>$lista]);

    }

    public function listaVendas()
    {
        $vendas = Vendas::with('itens')->orderBy('created_at','desc')->get();

        return $vendas;
    }

    public function delete($id='')
    {
        

        //Deleta todos os itens da venda

        $listaItens = VendasItem::where('venda_id',$id)->get();

        $user_id = CRUDBooster::myId(); // Pegar id do usuario

        foreach ($listaItens as $key => $v) {
            
            $est = Estoque::where([
                ['produto_id',$v->produto_id],
                ['operacao',3],
                ['comentarios','like','%#'.$p->venda_id.'%']
            ])
            ->first();

            $estoqueData = new Estoque;
            $estoqueData->produto_id = $v->produto_id;
            $estoqueData->user_id = $user_id;
            $estoqueData->operacao = 7;
            $estoqueData->qty = 1;

            $estoqueData->comentarios = "Exclusão da Venda #".$v->venda_id."";

            $estoqueData->save();
        }


         $itens = VendasItem::where('venda_id', $id)->delete();
        

         $venda = Vendas::find($id)->delete();


        
        return redirect()->route('vendas')->with('message','Venda excluida com sucesso!');       
    }


    public function estornar($id='',$venda_id='')
    {
            


            $user_id = CRUDBooster::myId(); // Pegar id do usuario
            
            $item = VendasItem::find($id);
            

            if(isset($item))
            {
               
            $estoqueData = new Estoque;
            $estoqueData->produto_id = $item->produto_id;
            $estoqueData->user_id = $user_id;
            $estoqueData->operacao = 7;
            $estoqueData->qty = 1;
            $estoqueData->comentarios = "Estorno do Produto #".$item->id." Venda #".$item->venda_id."";
            $estoqueData->save();


            $estorno = VendasItem::where('id',$id)->update(['estornado'=>1]);
               
            }

            return redirect()->route('venda',['id'=>$item->venda_id])->with('message','Item estornado com sucesso!'); 
            


    }



}
