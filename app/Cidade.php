<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{

	
	protected $guarded = ['id', 'updated_at', 'created_at'];
	
    public function barbearias(){
        return $this->hasMany('App\Barbearia');
    }
    
}
