<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Envio;
use App\Models\EnvioItem;
use App\Models\Estoque;
use \Auth;




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

       return view('home');

    }

    public function envios()

    {

            $envios = Envio::whereHas('itens')->withCount('itens')->find(1);

            $envio_id = $envios->id;


            $itens = EnvioItem::with('produto')->where('envio_id', $envio_id)->get();



            foreach ($itens as $item) {



                for ($i=0; $i < $item->qtde; $i++) { 
                    
                  echo $item->produto->nome;
                  echo "<br>";
                 }

                


                # code...
            }
    }

    public function estoque($codigo)
    {

                      
            $item = Produtos::where('codigo',$codigo)->get()->first();


            $estoque = new Estoque;
            $estoque->produto_id = $item->id;
            $estoque->user_id = Auth::user()->id;
            $estoque->in_out_qty = 1;
            $estoque->remarks = 'Entrada de '.$value->qtde.' iten(s) no estoque';
            $estoque->save();

            return $estoque;

          

    }

  
}
