<?php

namespace App\Http\Controllers\Admin;

use App\Barbearia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BarbeariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.admin.barbearias')->with('barbearias', Barbearia::all());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barbearia  $barbearia
     * @return \Illuminate\Http\Response
     */
    public function show(Barbearia $barbearia)
    {
        if ($barbearia->ativacao == 0) {
            $barbearia->ativacao = 1;
            $barbearia->plano_id = $barbearia->pagamentos->last()->plano_id;
            $barbearia->ativacao_at = date('Y-m-d');
            $barbearia->save();
            return back()->with('success', 'Barbearia ativada com sucesso');
        }
        else{
            $barbearia->update(['ativacao' => 0]);
            return back()->with('success', 'Barbearia desativada com sucesso');


        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barbearia  $barbearia
     * @return \Illuminate\Http\Response
     */
    public function edit(Barbearia $barbearia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barbearia  $barbearia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barbearia $barbearia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barbearia  $barbearia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barbearia $barbearia)
    {
        //
    }
}
