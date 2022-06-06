<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Pedido;
use App\Models\Peca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }


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
        $empresa = session('empresa');
        
        $peca = $request->peca;

        $peca = Peca::find($peca);

        $pedidoExistente = Pedido::where('id_usuario', Auth::user()->id)->where('ck_finalizado', 'N')->where('dt_pagamento', null)->where('id_empresa', '=', $empresa->id)->first();

        $quantidade = 1;

        if ($pedidoExistente == null) {
            $request->request->add(['id_usuario' => Auth::user()->id]);
            $request->request->add(['dt_pedido' => Carbon::now()]);

            $request->request->add(['vl_preco_total' => $peca->vl_peca]);

            $request->request->add(['id_empresa' => $empresa->id]);

            $pedido = Pedido::create($request->all());
            $peca->pedidos()->attach($pedido, ['qt_peca' => $quantidade, 'vl_total_peca' => $peca->vl_peca * $quantidade]);

            $peca->retirarDoEstoque($peca->id);

            return redirect('/loja/'.session('empresa')->url_customizada.'/pedido/'.$pedido->id);
        } else {
            $peca->pedidos()->attach($pedidoExistente->id, ['qt_peca' => $quantidade, 'vl_total_peca' => $peca->vl_peca * $quantidade]);
            $pedidoExistente->vl_preco_total =  $pedidoExistente->vl_preco_total + $peca->vl_peca * $quantidade;
            $pedidoExistente->update(array($pedidoExistente));

            $peca->retirarDoEstoque($peca->id);

            return redirect('/loja/'.session('empresa')->url_customizada.'/pedido/'.$pedidoExistente->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($cd_empresa, Pedido $pedido)
    {
        $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

        if ($empresa == null) {
            return redirect()->back();
        }

        session(['empresa' => $empresa]);

        $pecas = Pedido::find($pedido->id)->pecas()->orderBy('nm_peca', 'ASC')->get();
        return view('pedidos.show')->with('pedido', $pedido)->with('pecas', $pecas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //Mesma página do show.blade
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update($cd_empresa, Request $request, Pedido $pedido)
    {
        $request->request->add(['ck_finalizado' => 'S']);
        $pedido->update($request->all());
        return view('pedidos.pagar')->with('pedido', $pedido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {        
        $pedido->pecas()-> detach();
        $pedido->delete();
        
        return redirect('/dashboard');
    }
}
