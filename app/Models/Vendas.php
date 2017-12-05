<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function itens()
    {
    	return $this->hasMany('App\Models\VendasItem','venda_id');
    }
    
}
