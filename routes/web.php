<?php

use App\Models\Peca;
use App\Models\Pedido;
use App\Http\Controllers\PecaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\TipoCarroController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $pecas = Peca::take(8)->inRandomOrder()->where('qt_estoque', '>', 0)->get();
    return view('welcome')->with('varPeca', $pecas);
});

Route::get('pecas/nome/{nm_peca}', function ($nm_peca) {    
    $peca = DB::table('pecas')->whereRaw(' UPPER(nm_peca) LIKE ? ', [strtoupper($nm_peca).'%'])->get();
    return $peca;
});

Route::get('pecas/delete/{id}', function ($id) {
    $peca = Peca::find($id);
    $carros = Peca::find($peca->id)->carros()->get();
    return view('pecas.destroy')->with('peca', $peca)->with('carros', $carros);
})->middleware('auth');;

Route::get('/pecas/todos/{nome?}', function($nome = null){
    if ($nome != null) {
        $pecas = Peca::orderBy('qt_estoque', 'DESC')->orderBy('nm_peca', 'DESC')->whereRaw(' UPPER(nm_peca) LIKE ? ', [strtoupper($nome).'%'])->paginate(15);
    }else{
        $pecas = Peca::orderBy('qt_estoque', 'DESC')->orderBy('nm_peca', 'DESC')->paginate(15);
    }
    return view('pecas.lista')->with('varPeca', $pecas);
});

Route::get('/cadastrar', function(){
    return view('usuarios.create');
})->name('cadastro')->middleware('guest');;

Route::get('/dashboard', function(){
    $pedidos = Pedido::where('id_usuario', Auth::user()->id)->get();
    return view('pedidos.dashboard')->with('pedidos', $pedidos);
})->middleware('auth');

Route::get('pedido/pagar/{id}', function($id){
    $pedido = Pedido::where('id_usuario', Auth::user()->id)->where('id', $id)->first();
    return view('pedidos.pagar')->with('pedido', $pedido);
})->middleware('auth');

Route::get('pedido/cancelar/{id}', function($id){
    DB::table('pedidos')
        ->where('id', $id)
        ->limit(1)
        ->update(array('ck_finalizado' => 'C'));

        return redirect('/dashboard');
})->middleware('auth');

Route::get('pedido/pagar/concluir/{id}', function($id){
    $pedido = Pedido::where('id', $id)->first();
    try{
        DB::table('pedidos')
        ->where('id', $pedido->id)
        ->limit(1)
        ->update(array('dt_pagamento' => Carbon::now()));
        $message = ['titulo'=>'Sucesso!', 'corpo' => 'Parabéns! Seu pedido foi pago e aprovado!'];
        return view('pedidos.concluido')->with('message', $message);
    }catch(Exception){
        $message = ['titulo'=>'Erro', 'corpo' => 'Houve algum erro ao pagar seu pedido'];
        return view('pedidos.concluido')->with('message', $message);
    }
    
});

Route::resource('pecas', PecaController::class);

Route::resource('pedido', PedidoController::class);

Route::resource('carros', CarroController::class);

Route::resource('tiposcarro', TipoCarroController::class)->middleware('auth');;

Route::resource('usuarios', UsuarioController::class);

Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
