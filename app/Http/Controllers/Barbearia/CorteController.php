<?php

namespace App\Http\Controllers\Barbearia;

use App\Corte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CorteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.barbearia.corte');
        
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

        $file = $request->file('image'); // retorna o objeto em questão
        if($file != ''){
            $extensao = $file->getClientOriginalExtension();
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extensao;
            $file->move(public_path('imagens'), $filename);
            $request['foto'] = $filename;
        }
        Corte::create($request->except(['image']));
        return back()->with('success', 'Corte criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function show(Corte $corte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function edit(Corte $corte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corte $corte)
    {
            $file = $request->file('image'); // retorna o objeto em questão
            if($file != ''){
                $extensao = $file->getClientOriginalExtension();
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extensao;
                $file->move(public_path('imagens'), $filename);
                $request['foto'] = $filename;
            }
            Corte::find($corte->id)->update($request->except(['image']));
            return back()->with('success', 'Corte atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corte  $corte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corte $corte)
    {
        $corte->delete();
        return back()->with('success', 'Corte excluido com sucesso!');
    }
}
