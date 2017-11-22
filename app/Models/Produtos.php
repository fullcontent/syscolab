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
}
