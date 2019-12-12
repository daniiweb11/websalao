<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vale extends Model
{
	protected $guarded = ['id', 'updated_at', 'created_at'];
    
    public function fidelizacao(){
        return $this->belongsTo('App\Fidelizacao');
    }
}
