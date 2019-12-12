<?php

namespace App\Http\Controllers\cliente;

use App\Fidelizacao;
use App\Vale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FidelizacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.cliente.fidelizacao');    
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
        $fidelizacao = Fidelizacao::find($request->id);
        if($fidelizacao->cortes < 10){
            return back()->with('error', 'Você precisa ter pelo menos 10 cortes para gerar um vale!');
        }
        else{
            $fidelizacao->cortes -= 10;
            $fidelizacao->save(); 
            $vale = $fidelizacao->vales()->create();
            return back()->with('success', 'Vale gerado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fidelizacao  $fidelizacao
     * @return \Illuminate\Http\Response
     */
    public function show(Fidelizacao $fidelizacao)
    {
        return view('painel.cliente.vale')->with('fidelizacao', $fidelizacao);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fidelizacao  $fidelizacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Fidelizacao $fidelizacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fidelizacao  $fidelizacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fidelizacao $fidelizacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fidelizacao  $fidelizacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fidelizacao $fidelizacao)
    {
        //
    }
}
