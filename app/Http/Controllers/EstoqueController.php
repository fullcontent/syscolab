<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Produtos;
use CRUDBooster;
use Input;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $itens = Estoque::with('produto','user')->orderBy('id','DESC')->take(5)->get();

      return view('estoque', compact('itens'))->with('message','Adicionando Produto');
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
        //

        //dd($request->only('codigo'));


        $userId = CRUDBooster::myId();
        $codigo = Input::get('codigo');

        

        $itens = Estoque::orderBy('id','DESC')->take(5)->get();




         try
            {
                $item = Produtos::where('codigo','like', $codigo)->orWhere('codigo','like', '%'.$codigo.'%')->firstOrFail();
                

            }
            
            catch(ModelNotFoundException $e)
            {
                


                return view('estoque', compact('itens'))->with('message','Produto nao Encontrado');

            }



            $estoque = new Estoque;
            $estoque->produto_id = $item->id;
            $estoque->user_id = $userId;
            $estoque->in_out_qty = 1;
            $estoque->remarks = ''.$item->nome.' está em nosso estoque!';
            $estoque->save();


            CRUDBooster::sendNotification($config=[
                'content'=>$estoque->remarks,
                 'to'=>CRUDBooster::adminPath('notifications'),
                 'id_cms_users'=>[$item->user_id,$userId]]);


        return view('estoque', compact('itens'))->with('message','Cadastrado');

            

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
