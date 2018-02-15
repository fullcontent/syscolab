<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
     public function itens()			
    {
    	return $this->hasMany('App\Models\RelatorioItem','relatorio_id');
    }

    public function colaber()
    {
    	return $this->belongsTo('App\Models\Colaber','colaber_id','user_id');
    }

   
}
