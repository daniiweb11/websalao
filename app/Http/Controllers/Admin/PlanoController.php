<?php

namespace App\Http\Controllers\Admin;

use App\Plano;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('painel.admin.planos')->with('planos', Plano::all());
        
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

        Plano::create($request->all());
            
        return back()->with('success', 'Plano criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function show(Plano $plano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function edit(Plano $plano)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plano $plano)
    {
        $plano->update($request->all());
        return back()->with('success', 'Plano atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plano  $plano
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plano $plano)
    {
        $plano->delete();
        return back()->with('success', 'Plano deletado com sucesso!');
    }
}
