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
        return $this->belongsTo('App\User','user_id');
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
        return $this->hasMany('App\Models\VendasItem','produto_id');
    }

    public function qtdeVendas()
    {
        return $this->hasMany('App\Models\VendasItem','produto_id')->count();
    }

    public function estoque()
    {   

        
        $vendas = $this->hasMany('App\Models\VendasItem','produto_id')->count();
        $saidaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',0)->count();
        $entradaEstoque = $this->hasMany('App\Models\Estoque','produto_id')->where('operacao',1)->count();

        return $entradaEstoque - $vendas - $saidaEstoque;
    }
}
