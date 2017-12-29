<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    
    public function categoria()

  	{
    	return $this->belongsTo('App\Models\Categorias');
    }

    public function colaber()

    {
        return $this->belongsTo('App\Models\Colaber','user_id','user_id');
    }

    public function envios()
    {

    	return $this->hasMany('App\Models\EnvioItem','produto_id');
    }

    public function entradaEstoque()
    
    {

    	return $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',1);
    }

    public function saidaEstoque()
    
    {

        return $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',0);
    }

    public function venda()
    {
        return $this->hasMany('App\Models\VendasItem','produto_id')->whereNull('estornado');
    }

    public function vendasMes()
    {
        
       

        return $this->hasMany('App\Models\VendasItem','produto_id')->whereNull('estornado');

    }

    public function qtdeVendas()
    {
        return $this->hasMany('App\Models\VendasItem','produto_id')->count();
    }

    

    public function estoque()
    {   

        
        $vendasFeira = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',3)->count();
        $saidaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',5)->count();
        $entradaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',4)->count();

        return $entradaEstoque - $vendasFeira - $saidaEstoque;
    }

     public function estoqueFeira()
    {   

        
        $vendas = $this->hasMany('App\Models\VendasItem','produto_id')->where('localVenda',2)->count();
        $saidaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',2)->count();
        $entradaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',1)->count();

        return $entradaEstoque - $vendas - $saidaEstoque;
    }

    public function EntradaEstoqueCasa()
    {
        return $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',4);
    }

    public function EntradaEstoqueFeira()
    {
        return $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',1);
    }

    public function SaidaEstoqueCasa()
    {
        return $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',5);
    }

    public function SaidaEstoqueFeira()
    {
        return $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',2);
    }

    public function VendasCasa()
    {       
        return $this->hasMany('App\Models\VendasItem','produto_id')->where('localVenda',1);
    }

    public function VendasFeira()
    {
        return $this->hasMany('App\Models\VendasItem','produto_id')->where('localVenda',2);
    }

    
    public function estoqueCasa()
    {
        $vendas = $this->hasMany('App\Models\VendasItem','produto_id')->where('localVenda',1)->count();
        $saidaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',5)->count();
        $entradaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',4)->count();

        return $entradaEstoque - $vendas - $saidaEstoque;
    }
}
