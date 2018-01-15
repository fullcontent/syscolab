<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Relatorio;
use App\Models\RelatorioItem;
use App\Models\Vendas;
use App\Models\VendasItem;
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
            40 => '40%',
            50 => '50%'
            
        );


        $lista = Relatorio::with('colaber')->get();



        return view('relatorios.lista')
                ->with([
                    'colabers'=>$colabers,
                    'mes'=>$meses,
                    'porcentagem'=>$porcentagem,
                    'relatorios'=>$lista

                ]);
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


    	$report = Relatorio::where([['colaber_id',$colaber->user_id]])->whereMonth('created_at',$mes)->count();


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

        $users[] = $colaber->user_id;

        CRUDBooster::sendNotification($config=[
                'content'=>'Seu relatorio está pronto!',
                 'to'=>CRUDBooster::adminPath('relatorio/view/'.$relatorio->id.''),
                 'id_cms_users'=>$users]);


    	return "salvo";

    	}

    	else{

    		return "nao salvou";
    	}


        	

    }

    public function test($mes)
    {
        
        $id = CRUDBooster::myId();
        $report = Relatorio::where('colaber_id',$id)->first();
        $ano = date('Y',strtotime($report->created_at));
      
        $porcentagem = $report->porcentagem;


        if($report->count()>0){
        
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


        $mes = ltrim($mes,'0');
        $meses = array(
        1 =>    'Janeiro',
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

        return view('relatorios.relatorio')->with(['lista'=>$meusProdutos, 'colaber'=>$colaber,'mes'=>$mes,'ano'=>$ano,'porcentagem'=>$porcentagem]);

        }

        else{

            return "nenhum relatório pra você ainda";
        }

    }



    public function verRelatorio($id)
    {
        $relatorio = Relatorio::find($id);
        $mes = date('m',strtotime($relatorio->created_at));
        $colaber = Colaber::where('user_id',$relatorio->colaber_id)->first();
        $porcentagem = $relatorio->porcentagem;
        $id = $relatorio->colaber_id;

        // dd($relatorio);


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


        // dd($porcentagem);

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

        $mes = ltrim($mes,'0');
        $mes = $meses[$mes];





         return view('relatorios.venda')->with(['lista'=>$meusProdutos, 'colaber'=>$colaber,'mes'=>$mes,'porcentagem'=>$porcentagem]);
    }



    public function delete($id)
    {
        $relatorio = Relatorio::find($id);
        $relatorio->delete();

        return redirect()->route('relatorios')->with(['message'=>'Relatorio Excluido com sucesso','message_type'=>'success']);
    }



    public function relatorioVendas()
    {
        
            $vendas = Vendas::orderBy('created_at','asc')->get();
            $itens = VendasItem::all();


            return view('vendas.relatorio')
                    ->with([
                        'lista'=>$vendas,
                        'itens'=>$itens,
                    ]);            
    }


    public function relatorioCompleto($fromDt,$toDt)
    {
        


        
        $vendas = Vendas::with('itens')
                    // ->take(15)
                    // ->whereDate('created_at','>=', $fromDt)
                    // ->whereDate('created_at','<=', $toDt)
                    ->whereBetween('created_at', [$fromDt,$toDt])
                    ->orderBy('id','asc')
                    ->get();
      

        

         return view('relatorios.completo')->with(['vendas'=>$vendas]);

    }
    
}
