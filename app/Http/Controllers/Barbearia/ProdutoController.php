<?php

namespace App\Http\Controllers\Barbearia;

use App\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.barbearia.produto');
        
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
        Produto::create($request->except(['image']));
        return back()->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $file = $request->file('image'); // retorna o objeto em questão
            if($file != ''){
                $extensao = $file->getClientOriginalExtension();
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extensao;
                $file->move(public_path('imagens'), $filename);
                $request['foto'] = $filename;
            }
            Produto::find($produto->id)->update($request->except(['image']));
            return back()->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $barbeiro->delete();
        return back()->with('success', 'Produto deletado com sucesso!');
    }
}
