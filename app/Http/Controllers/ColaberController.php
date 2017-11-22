<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Models\Colaber;
use CRUDBooster;

class ColaberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = CRUDBooster::myId();

        $colaber = Colaber::where('user_id',$id)->get()->first();

        return view('home',compact('colaber'));
      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        


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

        
        $id = CRUDBooster::myId();

        $colaber = Colaber::where('user_id',$id)->first();

        $colaber->marca = $request->input('marca');
        $colaber->responsavel = $request->input('responsavel');
        $colaber->cnpj = $request->input('cnpj');
        $colaber->cpf = $request->input('cpf');
        $colaber->telefone = $request->input('telefone');
        $colaber->celular = $request->input('celular');
        $colaber->dadosBancarios = $request->input('dadosBancarios');

        $colaber->save();

        $url = CRUDBooster::adminPath();
        return redirect($url);
        




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
   
        return "metodo edit";
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
        
       return "metodo update";

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
