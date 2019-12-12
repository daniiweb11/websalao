<?php

namespace App\Http\Controllers\Barbearia;

use App\Barbeiro;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarbeiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.barbearia.barbeiro');
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
        $barbeiro = User::find($request->user_id);
        if($barbeiro){
            $file = $request->file('image'); // retorna o objeto em questão
            if($file != ''){
                $extensao = $file->getClientOriginalExtension();
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extensao;
                $file->move(public_path('imagens'), $filename);
                $request['foto'] = $filename;
            }
            Barbeiro::create($request->except(['image']));
            return back()->with('success', 'Barbeiro criado com sucesso!');
        }else{
            return back()->with('error', 'usuário '.$request->user_id.' não encontrado!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function show(Barbeiro $barbeiro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function edit(Barbeiro $barbeiro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barbeiro $barbeiro)
    {
            $file = $request->file('image'); // retorna o objeto em questão
            if($file != ''){
                $extensao = $file->getClientOriginalExtension();
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extensao;
                $file->move(public_path('imagens'), $filename);
                $request['foto'] = $filename;
            }
            Barbeiro::find($barbeiro->id)->update($request->except(['image']));
            return back()->with('success', 'Barbeiro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barbeiro  $barbeiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barbeiro $barbeiro)
    {
        $barbeiro->delete();
        return back()->with('success', 'Barbeiro deletado com sucesso!');
    }
}
