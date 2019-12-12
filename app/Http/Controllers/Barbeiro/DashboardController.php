<?php

namespace App\Http\Controllers\barbeiro;


use App\Agendamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\SampleChart;
use Db;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = Agendamento::selectRaw('day(agendamentos.data) day,year(agendamentos.data) year, month(agendamentos.data) month, count(agendamentos.id) valor')
                ->groupBy('day', 'year', 'month')
                ->orderBy('year')
                ->get();

        $meses = array();
        $valor = array();
        $lucro = array();
        foreach($result as $r){
            $meses[] =  $r->day . '-' . $r->month . '-' . $r->year;
        }
        foreach($result as $r){
            $valor[] = $r->valor;
        }


        $chart = new SampleChart;
        $chart->labels($meses);
        $chart->dataset('Agendamentos', 'line', $valor);


        return view('painel.barbeiro.dashboard', ['chart'=> $chart]);
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
        //
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
