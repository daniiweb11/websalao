<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fidelizacao extends Model
{
	protected $guarded = ['id', 'updated_at', 'created_at'];
    

    public function vales(){
        return $this->hasMany('App\Vale');
    }    
    public function barbearia(){
        return $this->belongsTo('App\Barbearia');
    }
	public function cliente(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
