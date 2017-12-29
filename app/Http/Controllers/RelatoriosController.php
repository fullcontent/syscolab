<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Relatorio;
use App\Models\RelatorioItem;
use App\Models\Colaber;
use App\Models\Produtos;
use CRUDBooster;

class RelatoriosController extends Controller
{
    public function index()
    {
        
        $colabers = User::where('id_cms_privileges',2)->orderBy('name')->get();
        $meses = array(
        1 => 'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            );
        $porcentagem = array(

            30 => '30%',
            20 => '20%',
            10 => '10%',
            
        );

        return view('relatorios.lista')->with(['colabers'=>$colabers,'mes'=>$meses,'porcentagem'=>$porcentagem]);
    }

    public function gerarRelatorio(Request $request)
    {
    	$id = $request->input('colaber');
        $mes = $request->input('mes');
        $porcentagem = $request->input('porcentagem');


        $colaber = Colaber::where('user_id',$id)->first();

        $meusProdutos = Produtos::whereHas('vendasMes', function($q) use ($mes)
        {
            $q->whereMonth('created_at', $mes);
        })
                        ->where('user_id',$id)
                        ->with('vendasMes')
                        ->withCount('venda')
                        ->get();

             
        foreach ($meusProdutos as $key => $v) {
            
            $total = $v->venda->sum('valor');

            $meusProdutos[$key]['total']=$total;
        }

        $meses = array(
        1 => 'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            );

        $mes = $meses[$mes];


        $this->salvarRelatorio($meusProdutos,$mes,$colaber,$porcentagem);
     


        return view('relatorios.venda')->with(['lista'=>$meusProdutos, 'colaber'=>$colaber,'mes'=>$mes,'porcentagem'=>$porcentagem]);
    }


    public function salvarRelatorio($meusProdutos,$mes,$colaber,$porcentagem)
    {	


    	//Check if Report Exists


    	$report = Relatorio::where([['colaber_id',$colaber->user_id]])->whereMonth('created_at',date('m'))->count();


    	if($report==0)
    	{
    		$id = CRUDBooster::myId();
    	$user_id = $colaber->user_id;
    	$relatorio = new Relatorio;

    	$relatorio->user_id = $id;
    	$relatorio->colaber_id = $user_id;
    	$relatorio->active = 1;
    	$relatorio->porcentagem = $porcentagem;

    	$relatorio->save();

    	
    	foreach($meusProdutos as $key => $l)
    	{
            foreach($l->venda as $v)
            {
            	$relatorioItem = new RelatorioItem;
            	$relatorioItem->relatorio_id = $relatorio->id;
            	$relatorioItem->venda_item_id = $v->id;
            	$relatorioItem->save();

            }
    	}

    	return "salvo";

    	}

    	else{

    		return "nao salvou";
    	}


    	
    	

    }

    
    



}
