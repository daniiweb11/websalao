<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barbeiro extends Model
{
    protected $guarded = ['id', 'updated_at', 'created_at'];
	
    public function barbearia(){
        return $this->belongsTo('App\Barbearia');
    }
    
    public function Agendamentos(){
        return $this->hasMany('App\Agendamento')->withTrashed();
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
