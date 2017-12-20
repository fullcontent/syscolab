<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Vendas;
use App\Models\VendasItem;
use App\Models\Produtos;



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

        $itens = VendasItem::where('venda_id', $id)->delete();

        $venda = Vendas::find($id)->delete();
        
        return redirect()->route('vendas');       
    }



}
