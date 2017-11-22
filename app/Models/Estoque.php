<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

   public function produto()
   {

   		return $this->belongsTo('App\Models\Produtos','produto_id');

   }

  
   
}
