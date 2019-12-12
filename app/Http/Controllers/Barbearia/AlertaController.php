<?php

namespace App\Http\Controllers\barbearia;
use Auth;
use App\Agendamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;   

class AlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamentos = Agendamento::where('data', date( "Y-m-d", strtotime( "-1 month" )))->where('barbearia_id', Auth::user()->barbearia->id)->get();
        return view('painel.barbearia.alerta')->with('agendamentos', $agendamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agendamentos = Agendamento::where('data', date( "Y-m-d", strtotime( "-1 month" )))->where('barbearia_id', Auth::user()->id)->get();
        $data = array('agendamentos' => $agendamentos);
         Mail::send('email.alertaCliente', $data, function($message) use ($data) {
         foreach($data['agendamentos'] as $a){
            $message->to($a->cliente->email, 'WebSalão')->subject('WebSalão');
         }
         $message->from('websalao@gmail.com', 'Não responda');
        });
        return back()->with('success', 'Os clientes foram alertados com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
