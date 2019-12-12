<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
     protected $guarded = ['id', 'updated_at', 'created_at'];


    public function barbearias(){
        return $this->belongsTo('App\Barbearia');
    }
}
