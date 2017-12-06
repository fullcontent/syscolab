<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Produtos;
use CRUDBooster;
use Input;
use Response;

class EstoqueSaidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       return view('estoque.saida');
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
        


       
       $user_id = CRUDBooster::myId(); //Pegar usuario logado

       $estoqueItens = EstoqueTemp::all();

       foreach ($estoqueItens as $e)
       {

            $estoqueData = new Estoque;
            $estoqueData->produto_id = $e->produto_id;
            $estoqueData->user_id = $user_id;
            $estoqueData->operacao = $e->operacao;
            $estoqueData->qty = $e->qty;
            $estoqueData->comentarios = $e->comentarios;
            $estoqueData->save();

       }

       EstoqueTemp::truncate();

       return redirect('admin/saidaEstoque')->with('message', 'Produtos retirados do estoque');

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
