<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Envio;
use App\Models\EnvioItem;




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

  
}
