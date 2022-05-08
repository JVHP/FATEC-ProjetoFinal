<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Peca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        $peca = $request->peca;

        $peca = Peca::find($peca);

        $pedidoExistente = Pedido::where('id_usuario', Auth::user()->id)->where('ck_finalizado', 'N')->where('dt_pagamento', null)->first();

        $quantidade = 1;

        if ($pedidoExistente == null) {
            $request->request->add(['id_usuario' => Auth::user()->id]);
            $request->request->add(['dt_pedido' => Carbon::now()]);

            $request->request->add(['vl_preco_total' => $peca->vl_peca]);

            $pedido = Pedido::create($request->all());
            $peca->pedidos()->attach($pedido, ['qt_peca' => $quantidade, 'vl_total_peca' => $peca->vl_peca * $quantidade]);

            $peca->retirarDoEstoque($peca->id);

            return redirect('/pedido/' . $pedido->id);
        } else {
            $peca->pedidos()->attach($pedidoExistente->id, ['qt_peca' => $quantidade, 'vl_total_peca' => $peca->vl_peca * $quantidade]);
            $pedidoExistente->vl_preco_total =  $pedidoExistente->vl_preco_total + $peca->vl_peca * $quantidade;
            $pedidoExistente->update(array($pedidoExistente));

            $peca->retirarDoEstoque($peca->id);

            return redirect('/pedido/' . $pedidoExistente->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
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
    public function update(Request $request, Pedido $pedido)
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
        $pedido->pecas()->detach();
        $pedido->delete();

        return redirect('/dashboard');
    }
}
