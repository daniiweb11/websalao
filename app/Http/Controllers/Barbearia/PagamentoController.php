<?php

namespace App\Http\Controllers\Barbearia;

use App\Pagamento;
use App\Barbearia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $barbearia = Barbearia::find($request->barbearia_id);
        $plano = $request->plano_id;

        if($plano == 1){ 
            $barbearia->update(['ativacao'=>1]);
            return back()->with('success', 'Parabéns! Sua barbearia foi ativa no prazo de 30 dias.');
        }else{

            Pagamento::create($request->all());
            return back()->with('success', 'Recebemos sua solicitação. Favor aguardar a aprovação!');
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function show(Pagamento $pagamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Pagamento $pagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagamento $pagamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagamento $pagamento)
    {
        //
    }
}
