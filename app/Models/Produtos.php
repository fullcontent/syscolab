<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    
    public function categoria()

  	{
    	return $this->belongsTo('App\Models\Categorias');
    }

    public function envios()
    {

    	return $this->hasMany('App\Models\EnvioItem','produto_id');
    }

    public function entradaEstoque()
    
    {

    	return $this->hasMany('App\Models\Estoque','produto_id')->where('in_out_qty',1);
    }

    public function saidaEstoque()
    
    {

        return $this->hasMany('App\Models\Estoque','produto_id')->where('in_out_qty','-1');
    }

    public function venda()
    {
        return $this->hasMany('App\Models\VendasItem','produto_id');
    }
}
