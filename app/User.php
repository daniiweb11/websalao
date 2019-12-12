<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'acesso', 'tipo', 'name', 'email', 'password', 'barbearia_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function barbearia(){
        return $this->hasOne('App\Barbearia');
    }
    public function barbeiro(){
        return $this->hasOne('App\Barbeiro');
    }

    public function agendamentos(){
        return $this->hasMany('App\Agendamento')->withTrashed();
    }
    public function fidelizacaos(){
        return $this->hasMany('App\Fidelizacao');
    }
}
