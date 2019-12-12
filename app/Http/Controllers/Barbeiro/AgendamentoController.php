<?php

namespace App\Http\Controllers\Barbeiro;

use App\Agendamento;
use App\Fidelizacao;
use App\Vale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;   
use Auth;
class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.barbeiro.agendamento');
    }
    public function hoje()
    {
        return view('painel.barbeiro.hoje');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Agendamento::create($request->all());
        return back()->with('success', 'Agendamento realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamento $agendamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {        
        if($agendamento->cliente){
        $data = array('autor'=> Auth::user()->tipo , 'cliEmail' => $agendamento->cliente->email , 'barEmail' => $agendamento->barbeiro->email );
         Mail::send('email.agendamentoCancel', $data, function($message) use ($data) {
         $message->to($data['cliEmail'], 'WebSalão')->subject('WebSalão');
         $message->to($data['barEmail'], 'WebSalão')->subject('WebSalão');
         $message->from('websalao@gmail.com', 'Não responda');
        });}
        $agendamento->delete();
        return back()->with('success', 'Agendamento cancelado com sucesso!');
    }
    public function finalizar(Agendamento $agendamento)
    {
        $agendamento->status = 1;
        $agendamento->save();
        $fidelizacao = Fidelizacao::where('user_id', $agendamento->user_id)->where('barbearia_id', $agendamento->barbearia_id)->first();
        $fidelizacao->cortes ++;
        $fidelizacao->save();

        return back()->with('success', 'Agendamento finalizado com sucesso!');
    }

    public function vale(Request $request){
        $vale = Vale::find($request->id);
        $agendamento = Agendamento::find($request->agendamento);

        if($vale){ 
            if($vale->fidelizacao->barbearia->id != Auth::user()->barbeiro->barbearia->id){
                return back()->with('error', 'Este vale não pertence a nossa barbearia!');

            }else{
                $agendamento->update(['status'=>1]);
                $vale->update(['status'=>1]);
                return back()->with('success', 'Agendamento finalizado com sucesso usando vale!');
            }
        }
        else {
            return back()->with('error', 'Vale não encontrado!');
        }
    }


}
