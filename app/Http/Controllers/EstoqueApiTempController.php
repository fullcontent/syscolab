<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EstoqueTemp;
use App\Models\Produtos;
use \Redirect, \Validator, \Input, \Session, \Response;
use Illuminate\Http\Request;
use CRUDBooster;

class EstoqueApiTempController extends Controller
{

    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user_id = CRUDBooster::myId();
        return Response::json(EstoqueTemp::with('produto')->where('user_id', $user_id)->get());
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
        $codigo = Input::get('codigo');
        $user_id = CRUDBooster::myId(); //Pegar codigo do usuario logado
        $operacao = Input::get('operacao');

        switch ($operacao) {
            case 1:
                $comentarios = "Entrada";
            break;
            
            case 0:
                $comentarios = "Saida";
            break;
        }

        try
            {
                $item = Produtos::where('codigo','like', $codigo)->orWhere('codigo','like', '%'.$codigo.'%')->firstOrFail();
                

            }
            
            catch(ModelNotFoundException $e)
            {
                
                return "erro";

            }


        $EstoqueTemp = new EstoqueTemp;
        $EstoqueTemp->produto_id = $item->id;
        $EstoqueTemp->operacao = $operacao;
        $EstoqueTemp->user_id = $user_id;

        $EstoqueTemp->qty = 1;
        $EstoqueTemp->comentarios = $comentarios;
        
     
        $EstoqueTemp->save();
              
        
        return $EstoqueTemp;




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
        EstoqueTemp::destroy($id);
    }
}
