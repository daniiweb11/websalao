<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
	protected $guarded = ['id', 'updated_at', 'created_at'];
	
    public function barbearia(){
        return $this->belongsTo('App\Barbearia');
    }
    
    public function plano(){
        return $this->belongsTo('App\Plano');
    }
}
