<?php
use App\Cidade;
use App\Barbearia;
use App\Produto;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome')->with('cidades', Cidade::all());
});

Auth::routes();

Route::get('/painel/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->prefix('painel/admin')->namespace('Admin')->group(function(){
		Route::resource('barbearias', 'BarbeariaController');
		Route::resource('planos', 'PlanoController');
        Route::resource('dashboard', 'DashboardController');
});

Route::middleware(['auth'])->prefix('painel/barbearia')->namespace('Barbearia')->group(function(){
		Route::resource('loja', 'BarbeariaController');
		Route::resource('cortes', 'CorteController');
		Route::resource('barbeiros', 'BarbeiroController');
		Route::resource('agendamentos', 'AgendamentoController');
        Route::resource('pagamentos', 'PagamentoController');
        Route::resource('dashboard', 'DashboardController');
        Route::resource('produtos', 'ProdutoController');
        Route::resource('alerta', 'AlertaController');
});
Route::middleware(['auth'])->prefix('painel/cliente')->namespace('Cliente')->group(function(){
		Route::resource('fidelizacao', 'FidelizacaoController');
		Route::get('agendamentos/{id}/{data}', 'AgendamentoController@seleciona');
		Route::get('agendamentos/remarcar/{agendamento}/{hora}', 'AgendamentoController@remarcar');
		Route::resource('agendamentos', 'AgendamentoController');
        Route::resource('perfil', 'PerfilController');
        Route::resource('vale', 'ValeController');


});


Route::middleware(['auth'])->prefix('painel/barbeiro')->namespace('Barbeiro')->group(function(){
		Route::get('hoje', 'AgendamentoController@hoje');
		Route::get('agendamento/finalizar/{agendamento}', 'AgendamentoController@finalizar');
        Route::post('agendamentos/vale', 'AgendamentoController@vale');
		Route::resource('agendamentos', 'AgendamentoController');
        Route::resource('dashboard', 'DashboardController');

});

Route::post('/cadastrar/agendamento', 'Cliente\AgendamentoController@store');


Route::get('/pesquisar/{id?}', function ($id) {
    return view('barbearias')->with('cidade', Cidade::find($id));
});

Route::get('/{nome?}', function ($nome) {
	$barbearia = Barbearia::where('nome', $nome)->first();
    $produtos = Produto::where('barbearia_id', $barbearia->id)->paginate(8);
    $cidade = Cidade::where('cidade_id', $barbearia->cidade_id);
    return view('barbearia')->with('barbearia', $barbearia)->with('produtos', $produtos)->with('cidade', $cidade);
});

