<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendasItem extends Model
{
    //
     public function produto()
    {
    	return $this->hasMany('App\Models\Produtos','id','produto_id');
    }

    public function venda()
    {
    	return $this->belongsTo('App\Models\Vendas','venda_id','id');
    }

    public function estorno()
    {
    	return $this->hasMany('App\Models\Estoque','produto_id','produto_id')->where('operacao',7);
    }
}
