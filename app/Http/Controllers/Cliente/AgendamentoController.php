<?php

namespace App\Http\Controllers\Cliente;

use App\Agendamento;
use App\Fidelizacao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;   


class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.cliente.agendamento');
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

        if(Agendamento::where('data', $request->data)->where('hora', $request->hora)->count() > 1){
            return back()->with('success', 'Agendamento já foi realizado!');
        }else{
            $agendamento = Agendamento::create($request->all());
            $fidelizacao = Fidelizacao::firstOrCreate(['user_id' => $request->user_id, 'barbearia_id' => $request->barbearia_id]);


            // $data = array('agendamento' => $agendamento);
            //  Mail::queue('email.agendamentoCreate', $data, function($message) use ($data) {
            //     $message->to($data['agendamento']->cliente->email, 'WebSalão')->subject('WebSalão');
            //  $message->from('websalao@gmail.com', 'Não responda');
            // });
             return back()->with('success', 'Agendamento realizado com sucesso!');
        }
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
        $agendamento->delete();
        return back()->with('success', 'Agendamento cancelado com sucesso!');
    }


    public function seleciona($id, $data)
    {
        $agendamento = Agendamento::where('barbeiro_id', $id)->where('data',$data)->get();
        echo $agendamento;
    
    }

    public function remarcar(Agendamento $agendamento, $hora){
        $agendamento->hora = $hora . ':00';
        $agendamento->save();
        return back()->with('success', 'Agendamento remarcado com sucesso!');
    }
}
