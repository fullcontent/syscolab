<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    

	public function user()
    {
        return $this->belongsTo('App\User');
    }

	public function itens()
    {

    	return $this->hasMany('App\Models\EnvioItem','envio_id');

    }


    

}
