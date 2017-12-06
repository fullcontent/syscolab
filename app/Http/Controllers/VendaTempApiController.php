<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\VendasTemp;
use App\Models\Produtos;
use \Redirect, \Validator, \Input, \Session, \Response;
use Illuminate\Http\Request;

class VendaTempApiController extends Controller
{
    
   


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return Response::json(VendasTemp::with('item')->get());

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

    $codigo = Input::get('codigo');



        try
            {
                $item = Produtos::where('codigo','like', $codigo)->orWhere('codigo','like', '%'.$codigo.'%')->firstOrFail();
                

            }
            
            catch(ModelNotFoundException $e)
            {
                
                return "erro";

            }


        $VendasTemp = new VendasTemp;
        $VendasTemp->produto_id = $item->id;
        $VendasTemp->valor = $item->valor;
        $VendasTemp->qtde = 1;
        $VendasTemp->total = $item->valor;

        
        $VendasTemp->save();
              
        
        return $VendasTemp;

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
    public function update($id)
    {
        $VendasTemp = VendasTemp::find($id);
        $VendasTemp->qtde = Input::get('qtde');
        $VendasTemp->total = Input::get('total');
        
        $VendasTemp->save();
        return $VendasTemp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VendasTemp::destroy($id);
    }

    public function cancelar()
    {
        VendasTemp::truncate();
    }
}
