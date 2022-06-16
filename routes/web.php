<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\Peca;
use App\Models\User;
use App\Models\Carro;
use App\Models\Pedido;
use App\Http\Controllers\PecaController;
use App\Http\Controllers\PecaClienteController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\EmpresaAdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidosEmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioClienteController;
use App\Http\Controllers\TipoCarroController;
use App\Http\Controllers\TipoPecaController;
use App\Models\Empresa;
use App\Models\Marca;
use App\Models\TipoCarro;
use App\Models\TipoPeca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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
    /* $pecas = Peca::take(8)->inRandomOrder()->where('qt_estoque', '>', 0)->get(); */
    session(['cd_empresa' => null]);
    return view('welcome')/* ->with('varPeca', $pecas) */;
});

/* WELCOME loja */
Route::get('/loja/{cd_empresa?}', function ($cd_empresa = null) {
    if ($cd_empresa != null){

        $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

        session(['empresa' => $empresa]);

        if ($empresa == null) {
            return redirect()->back();
        }
        
        $pecas = Peca::take(5)->inRandomOrder()->where('qt_estoque', '>', 0)->where('id_empresa', $empresa->id)->get();
        return view('welcome-company')->with('varPeca', $pecas);

    } else {
        return redirect()->back();
    }
});

/* Carros */
Route::get('/carros-registro/{cd_empresa}/{ano}/{id_marca}', function ($cd_empresa, $ano, $id_marca) {

    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    $carros = Carro::join('tipo_carros', 'tipo_carros.id', '=', 'carros.id_tipo_carro')
                    ->where('ano', $ano)
                    ->where('id_marca', $id_marca)
                    ->where('carros.id_empresa', $empresa->id)
                    ->orderBy('ano', 'DESC')
                    ->orderBy('nm_carro', 'ASC')
                    ->select('carros.nm_carro', 'carros.id', 'tipo_carros.nm_tipo')
                    ->get();

    if (sizeof($carros) > 0) {
        $carrosGroup = $carros->groupBy('nm_tipo');

        return $carrosGroup;
    }

    return $carros;
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
Route::get('/loja/{cd_empresa}/pecas/nome/{nm_peca}', function ($cd_empresa, $nm_peca) {    
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);

    $peca = DB::table('pecas')->select(DB::raw('nm_peca, id'))->where('id_empresa', '=', $empresa->id)->whereRaw(' UPPER(nm_peca) LIKE ? ', [strtoupper($nm_peca).'%'])->get();
    return $peca;
});

Route::get('/loja/{cd_empresa}/pecas/todos/{nome?}/{categoria_id?}', function($cd_empresa, $nome = null){
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);
    
    if ($nome != null) {
        $pecas = Peca::orderBy('qt_estoque', 'DESC')->orderBy('nm_peca', 'DESC')->where('id_empresa', '=', $empresa->id)->whereRaw(' UPPER(nm_peca) LIKE ? ', [strtoupper($nome).'%'])->paginate(15);
    }else{
        $pecas = Peca::orderBy('qt_estoque', 'DESC')->orderBy('nm_peca', 'DESC')->where('id_empresa', '=', $empresa->id)->paginate(15);
    }
    return view('pecas.lista')->with('varPeca', $pecas);
});

Route::get('/loja/{cd_empresa}/pecas-usuario', function($cd_empresa){
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);
    
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
Route::put('/pedidos-filial/enviar/{id}', function($id){

    $user = Auth::user();

    $consultaVinculoPedido = DB::table('pedidos')
    ->join('empresas', 'empresas.id', '=', 'pedidos.id_empresa')
    ->join('empresas_usuarios', 'empresas_usuarios.id_empresa', '=', 'empresas.id')
    ->where('empresas_usuarios.id_usuario', '=', $user->id);

    if ($consultaVinculoPedido == null) {
        return redirect()->back();
    }

    DB::table('pedidos')
    ->where('id', '=', $id)
    ->update(['ck_finalizado' => 'E']);
    
    return redirect('/pedidos-filial/');
})->middleware(['auth', 'company.user', 'verified']);


Route::get('/loja/{cd_empresa}/usuario/pedidos', function($cd_empresa){
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);

    $pedidos = Pedido::where('id_usuario', Auth::user()->id)->where('id_empresa', '=', $empresa->id)->orderBy('dt_pedido', 'DESC')->paginate(10);


    return view('pedidos.dashboard')->with('pedidos', $pedidos);
})->name('dashboard')->middleware(['auth', 'verified']);

Route::get('/loja/{cd_empresa}/pedido/pagar/{id}', function($cd_empresa, $id){
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);
    
    $pedido = Pedido::where('id_usuario', Auth::user()->id)->where('id', $id)->first();
    return view('pedidos.pagar')->with('pedido', $pedido);
})->middleware('auth');

Route::get('/loja/{cd_empresa}/pedido/cancelar/{id}', function($cd_empresa, $id){
        try {
            $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

            if ($empresa == null) {
                return redirect()->back();
            }

            session(['empresa' => $empresa]);

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

            return redirect('/loja/'.$cd_empresa.'/usuario/pedidos');
        } catch (Exception $ex) {
            return $ex;
        }
})->middleware(['auth', 'verified']);

Route::get('/loja/{cd_empresa}/pedido/pagar/concluir/{id}', function($cd_empresa, $id){
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);    

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

/* Route::get('/categorias-pecas/', function() {
    $tipos = DB::table('tipo_pecas')->where('ck_ativo', '=', '1')->get();
    return $tipos;
}); */

/* USUÁRIO */
Route::get('/loja/{cd_empresa}/usuario/informacoes', function($cd_empresa){
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);

    $dadosUsuario = Auth::user();
    return view('usuarios.config')->with('dadosUsuario', $dadosUsuario);
})->name('informacoes')->middleware('auth');

Route::get('/loja/{cd_empresa}/login', function($cd_empresa){
    $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

    if ($empresa == null) {
        return redirect()->back();
    }

    session(['empresa' => $empresa]);
    return view('auth.login-loja');
})->middleware(['guest'])->name('login-loja');


/* TIPOS CARRO */
Route::get('/tipos-carro-filial/{id_empresa}', function($id_empresa){
    $tiposCarro = TipoCarro::where('id_empresa', '=', $id_empresa)->get();
    
    return $tiposCarro;
});

/* TIPOS PEÇA */
Route::get('/tipos-peca-filial/{id_empresa}', function($id_empresa){
    $tiposPeca = TipoPeca::where('id_empresa', '=', $id_empresa)->where('ck_ativo', '=', 1)->get();
    
    return $tiposPeca;
});

/* MARCAS CARRO */
Route::get('/marcas-carro-filial/{id_empresa}', function($id_empresa){
    $marcas = Marca::whereIn('ck_categoria_marca', ['C', 'A'])->where('id_empresa', '=', $id_empresa)->get();
    
    return $marcas;
});

/* MARCAS PEÇA */
Route::get('/marcas-peca-filial/{id_empresa}', function($id_empresa){
    $marcas = Marca::whereIn('ck_categoria_marca', ['P', 'A'])->where('id_empresa', '=', $id_empresa)->get();
    
    return $marcas;
});


Route::resource('/loja/{cd_empresa}/pedido', PedidoController::class);

Route::resource('/loja/{cd_empresa}/pecas', PecaClienteController::class);

Route::resource('/loja/{cd_empresa}/cliente', UsuarioClienteController::class);

Route::resource('pecas', PecaController::class);

Route::resource('carros', CarroController::class);

Route::resource('tiposcarro', TipoCarroController::class)->middleware('auth');

Route::resource('tipospeca', TipoPecaController::class);

Route::resource('usuarios', UsuarioController::class);

Route::resource('marcas', MarcaController::class);

Route::resource('filiais', EmpresaController::class);

Route::resource('/pedidos-filial', PedidosEmpresaController::class);

Route::resource('/gerenciamento-empresas', EmpresaAdminController::class);

Auth::routes();