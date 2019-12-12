<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $guarded = ['id', 'updated_at', 'created_at'];


    public function barbearias(){
        return $this->hasMany('App\Barbearia');
    }

        public function pagamentos(){
        return $this->hasMany('App\Pagamento');
    }
}
