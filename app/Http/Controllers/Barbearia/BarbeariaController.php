<?php

namespace App\Http\Controllers\Barbearia;

use App\Barbearia;
use App\Cidade;
use App\Plano;
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

        return view('painel.barbearia.loja')->with('cidades', Cidade::all())->with('planos', Plano::all());
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

        if( Barbearia::where('nome', $request->nome)->count() > 0 ){
            return back()->with('error', 'barbearia já existente!');

        }else{

            $barbearia = new Barbearia();
            $barbearia->nome = str_replace(" ", "_", $request->nome);
            $barbearia->telefone = $request->telefone;
            $barbearia->email = $request->email;
            $barbearia->cidade_id = $request->cidade_id;
            $barbearia->user_id = $request->user_id;

            $barbearia->save();
            //Barbearia::create($request->all());
            return back()->with('success', 'Barbearia criada com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->abre and $request->abre > $request->fecha){
            return back()->with('error', 'O horário que a barbearia abre não pode ser maior do que ela fecha!');
        
        }else{
            $file = $request->file('image'); // retorna o objeto em questão
            if($file != ''){
                $extensao = $file->getClientOriginalExtension();
                $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extensao;
                $file->move(public_path('imagens'), $filename);
                $request['foto'] = $filename;
            }
            Barbearia::find($id)->update($request->except(['image']));
            return back()->with('success', 'Informações atualizadas com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
