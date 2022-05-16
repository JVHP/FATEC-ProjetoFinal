<?php

use App\Models\Peca;
use App\Models\User;
use App\Models\Pedido;
use App\Http\Controllers\PecaController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoCarroController;
use App\Http\Controllers\TipoPecaController;
use App\Models\TipoPeca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

/* WELCOME */
Route::get('/', function () {
    $pecas = Peca::take(8)->inRandomOrder()->where('qt_estoque', '>', 0)->get();
    return view('welcome')->with('varPeca', $pecas);
});

/* EMAIL */
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

/* PEÇAS */
Route::get('pecas/nome/{nm_peca}', function ($nm_peca) {    
    $peca = DB::table('pecas')->select(DB::raw('nm_peca, id'))->whereRaw(' UPPER(nm_peca) LIKE ? ', [strtoupper($nm_peca).'%'])->get();
    return $peca;
});

Route::get('pecas/delete/{id}', function ($id) {
    $peca = Peca::find($id);
    $carros = Peca::find($peca->id)->carros()->get();
    $tipoPeca = Peca::find($peca->id)->tipoPeca()->first();
    return view('pecas.destroy')->with('peca', $peca)->with('carros', $carros)->with('tipoPeca', $tipoPeca);
})->middleware('auth');

Route::get('/pecas/todos/{nome?}', function($nome = null){
    if ($nome != null) {
        $pecas = Peca::orderBy('qt_estoque', 'DESC')->orderBy('nm_peca', 'DESC')->whereRaw(' UPPER(nm_peca) LIKE ? ', [strtoupper($nome).'%'])->paginate(15);
    }else{
        $pecas = Peca::orderBy('qt_estoque', 'DESC')->orderBy('nm_peca', 'DESC')->paginate(15);
    }
    return view('pecas.lista')->with('varPeca', $pecas);
});

Route::get('/pecas-usuario', function(){
    $user = Auth::user();
    
    $pecas_carro = DB::table('carro_usuarios')->select(DB::raw('pecas.*'))->distinct()->join('carro_peca', 'carro_usuarios.id_carro', '=', 'carro_peca.carro_id')
    ->join('pecas', 'carro_peca.peca_id', '=', 'pecas.id')->where('carro_usuarios.id_usuario', '=', $user->id)->orderBy('qt_estoque', 'DESC')->orderBy('nm_peca', 'DESC')->paginate(15);

    $mensagem = '';

    if (sizeof($user->carros()->get()) == 0) {
        $mensagem = 'Não foram encontrados carros vinculados ao seu usuário';
    } else
    if (sizeof($pecas_carro) == 0) {
        $mensagem = 'Não foram encontradas peças para seu(s) carro(s) em nosos catálogo';
    }    
    return view('pecas.lista-carros-usuario')->with('varPeca', $pecas_carro)->with('mensagem', $mensagem);
})->middleware(['auth', 'verified']);

/* PEDIDOS */
Route::get('/dashboard', function(){
    $pedidos = Pedido::where('id_usuario', Auth::user()->id)->orderBy('dt_pedido', 'DESC')->get();
    return view('pedidos.dashboard')->with('pedidos', $pedidos);
})->name('dashboard')->middleware(['auth', 'verified']);

Route::get('pedido/pagar/{id}', function($id){
    $pedido = Pedido::where('id_usuario', Auth::user()->id)->where('id', $id)->first();
    return view('pedidos.pagar')->with('pedido', $pedido);
})->middleware('auth');

Route::get('pedido/cancelar/{id}', function($id){
        try {
            $pecasQtd = DB::table('peca_pedidos')
                        ->join('pedidos', 'pedidos.id', '=', 'peca_pedidos.id_pedido')
                        ->join('pecas', 'pecas.id', '=', 'peca_pedidos.id_peca')
                        ->select('peca_pedidos.qt_peca', 'peca_pedidos.id_peca')
                        ->where('pedidos.id', '=', $id)
                        ->get();    

            foreach($pecasQtd as $peca) {
             $pecas = Peca::find($peca->id_peca);       
             
             DB::table('pecas')
             ->where('id', '=', $peca->id_peca)
             ->update(['qt_estoque' => intval($pecas->qt_estoque + $peca->qt_peca)]);
            }
                            

            DB::table('pedidos')
                ->where('id', $id)
                ->limit(1)
                ->update(array('ck_finalizado' => 'C'));

            return redirect('/dashboard');
        } catch (Exception $ex) {
            return $ex;
        }
})->middleware(['auth', 'verified']);

Route::get('pedido/pagar/concluir/{id}', function($id){
    $pedido = Pedido::where('id', $id)->first();
    try{
        if ($pedido->dt_pagamento != null) {
            $message = ['titulo'=>'Aviso', 'corpo' => 'Parece que seu pedido já foi pago! Aguarde por mais notícias!'];
            return view('pedidos.concluido')->with('message', $message);
        }
        DB::table('pedidos')
        ->where('id', $pedido->id)
        ->limit(1)
        ->update(array('dt_pagamento' => Carbon::now()));
        $message = ['titulo'=>'Sucesso', 'corpo' => 'Parabéns! Seu pedido foi pago e aprovado!'];
        return view('pedidos.concluido')->with('message', $message);
    }catch(Exception){
        $message = ['titulo'=>'Aviso', 'corpo' => 'Houve algum erro ao pagar seu pedido'];
        return view('pedidos.concluido')->with('message', $message);
    }
});

/* USUÁRIO */
Route::get('/usuario/informacoes', function(){
    $dadosUsuario = Auth::user();
    return view('usuarios.config')->with('dadosUsuario', $dadosUsuario);
})->name('informacoes')->middleware('auth');


Route::resource('pecas', PecaController::class);

Route::resource('pedido', PedidoController::class);

Route::resource('carros', CarroController::class);

Route::resource('tiposcarro', TipoCarroController::class)->middleware('auth');

Route::resource('tipospeca', TipoPecaController::class);

Route::resource('usuarios', UsuarioController::class);

Route::resource('marcas', MarcaController::class);

Auth::routes();