<?php

namespace App\Http\Controllers\cliente;

use App\Vale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValeController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vale  $vale
     * @return \Illuminate\Http\Response
     */
    public function show(Vale $vale)
    {
        return view('painel.cliente.vale')->with('vale', $vale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vale  $vale
     * @return \Illuminate\Http\Response
     */
    public function edit(Vale $vale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vale  $vale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vale $vale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vale  $vale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vale $vale)
    {
        //
    }
}
