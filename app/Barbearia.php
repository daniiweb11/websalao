<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barbearia extends Model
{
    

	protected $guarded = ['id', 'updated_at', 'created_at'];
    protected $casts = [
        'semana' => 'array'
    ];



    public function cidade(){
        return $this->belongsTo('App\Cidade');
    }    
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function plano(){
        return $this->belongsTo('App\Plano');
    }
    public function cortes(){
        return $this->hasMany('App\Corte');
    }
    public function barbeiros(){
        return $this->hasMany('App\Barbeiro');
    }
    public function produtos(){
        return $this->hasMany('App\Produto');
    }
    
    public function agendamentos(){
        return $this->hasMany('App\Agendamento');
    }
    public function fidelizacaos(){
        return $this->hasMany('App\Fidelizacao');
    }
    public function pagamentos(){
        return $this->hasMany('App\Pagamento');
    }

    public function horarios(){
        $abre = substr($this->abre,0,2);
        $fecha =  substr($this->fecha,0,2);
        $horarios = array();
        for($i = $abre; $i<=$fecha; $i++){
            $horarios[] += $i ;
        }
        return json_encode($horarios);
    }

    public function horarios2($data){
        $horarios = array();
        foreach($this->agendamentos as $ag){
            if($ag->data == $data){
                $horarios[] = $ag->hora;
            }
        }
        return $horarios;
    }

    public function valor_total(){
        $results= 0;
        foreach($this->agendamentos as $a){
            if($a->status == 1){
                if($a->data == date('Y-m-d'))
                    $results += $a->valor();
            }

        }
        return $results;
    }


}
