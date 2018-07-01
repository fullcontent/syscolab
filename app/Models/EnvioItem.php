<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvioItem extends Model
{
    
   public function produto()
   {

   		return $this->belongsTo('App\Models\Produtos','produto_id');

   }


   public function envio()
   {

   	return $this->belongsTo('App\Models\Envio','envio_id');
   }   
   
}
