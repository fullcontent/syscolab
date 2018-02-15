<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Vendas;
use App\Models\VendasTemp;
use App\Models\VendasItem;
use App\Models\Estoque;
use App\Models\Produtos;
use \Redirect, \Validator, \Input, \Session;

use CRUDBooster;

class VendaFeiraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

       return view('vendas.feira')
       			->with('localVenda',2);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $userID = CRUDBooster::myId(); // Pegar id do usuario
        $localVenda = Input::get('localVenda');


        $venda = new Vendas;
        $venda->user_id = $userID; //Inserir id do usuario logado
        $venda->tipoPagamento = Input::get('tipoPagamento');

        $venda->valorVenda = Input::get('valorVenda');
        $venda->valorRecebidoDinheiro = Input::get('valorRecebidoDinheiro');
        $venda->valorRecebidoDebito = Input::get('valorRecebidoDebito');
        $venda->valorRecebidoCredito = Input::get('valorRecebidoCredito');
        $venda->parcelasCredito = Input::get('parcelasCredito');


        $venda->desconto = Input::get('desconto');
        $venda->localVenda = $localVenda;
        $venda->comentarios = Input::get('comentarios');

        if(Input::get('dataVenda'))
            {
                // dd(Input::get('dataVenda'));
                $venda->created_at = new \DateTime(Input::get('dataVenda'));
            }


        $vendaItens = VendasTemp::where('localVenda',$localVenda)->get();


        if($vendaItens->count() > 0)
        {

             $venda->save();


        }

        else{


        }
        


       
       

        
        foreach ($vendaItens as $v){

            $vendaItemData = new VendasItem;

            $vendaItemData->venda_id = $venda->id;
            $vendaItemData->produto_id = $v->produto_id;
            $vendaItemData->valor = $v->valor;
            $vendaItemData->qtde = $v->qtde;
            $vendaItemData->total_venda = $v->total;
            $vendaItemData->localVenda = $localVenda;
            $vendaItemData->created_at = $venda->created_at;


            $vendaItemData->save();

            $temp = VendasTemp::find($v->id)->delete();

            $produtos = Produtos::find($v->produto_id);

                $estoque = new Estoque;
                $estoque->produto_id = $v->produto_id;
                $estoque->user_id = $userID;
                $estoque->qty = -($v->qtde);
                $estoque->operacao = 3;
                $estoque->comentarios = 'Venda na Feira #'.$venda->id;
                $estoque->save();
        }

        


        return redirect('admin/vendasFeira')
            ->with([
                'message'=>'Venda efetuada com sucesso!',
                'message_type' => 'success'

            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
