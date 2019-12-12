<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Agendamento extends Model
{
    use SoftDeletes;
    protected $dates   = ['deleted_at'];
	protected $guarded = ['id', 'updated_at', 'created_at'];

	public function barbearia(){
        return $this->belongsTo('App\Barbearia');
    }
	public function cliente(){
        return $this->belongsTo('App\User', 'user_id');
    }
	public function corte(){
        return $this->belongsTo('App\Corte');
    }
	public function barbeiro(){
        return $this->belongsTo('App\Barbeiro');
    }

    public function valor(){
        return $this->corte->valor;
    }
}
