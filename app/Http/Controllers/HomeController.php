<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Envio;
use App\Models\EnvioItem;
use App\Models\Estoque;
use \Auth;
use App;
use PDF;
use App\User;

use DNS1D;




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


            $html = "<div class='row invoice-info'>";
        

            foreach ($itens as $item) {
                for ($i=0; $i < $item->qtde; $i++) { 
                $codigo = $item->produto->codigo;
                $code = DNS1D::getBarcodeSVG($codigo, "EAN8",2);
                    
        $html .= "<div class='col-sm-2' align='center' style='border: 1px #ccc dotted;'>";

        $html .= "<p>".$item->produto->nome."</p>".$code."<p>Código: ".$codigo."</p><h4>R$ ".$item->produto->valor."</h4>";

                 $html .= "</div>";
                  
                 }

                
                  
            }
            $html .= "</div>" ;


            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($html);


            //return $pdf->stream('etiquetas.pdf');
                        
            return view('etiquetas')->with('html',$html);



            

            
            
            
            
              

                  
    
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


    public function users()
    {


        $gerencia = User::where('id_cms_privileges',2)->get();


            foreach($gerencia as $g){

                $user[]=$g->id;
            }

            dd($user);

           

    }

  
}
