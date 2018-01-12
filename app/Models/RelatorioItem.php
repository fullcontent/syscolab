<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatorioItem extends Model
{
    public function relatorio()			
    {
    	return $this->belongsTo('App\Models\Relatorio');
    }

    

    
}
