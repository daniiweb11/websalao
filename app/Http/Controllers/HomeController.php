<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barbearia;
use Auth;
use Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->tipo == 'barbearia'){
            // if(Auth::user()->barbearia){
            //     if(Auth::user()->barbearia->ativacao ==1){
            //     $hoje = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
            //     $ativado_at = Carbon::createFromFormat('Y-m-d', Auth::user()->barbearia->ativacao_at);
            //     $diferenca = $hoje->diffInDays($ativado_at);
            //     if($diferenca >= Auth::user()->barbearia->plano->duracao){
            //         Auth::user()->barbearia->ativacao = 0;
            //         Auth::user()->barbearia->save();
            //     }
            //     }

            //     return redirect('/painel/barbearia/loja');
            // }
            return redirect('/painel/barbearia/loja');

        }
        if(Auth::user()->tipo == 'barbeiro'){
            return redirect('/painel/barbeiro/dashboard');

        }
        if(Auth::user()->tipo == 'cliente'){
            return redirect('/painel/cliente/perfil');

        }
        
        if(Auth::user()->tipo == 'admin'){
            return redirect('/painel/admin/dashboard');

        }


    }
}
