<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacaoManutencaoCarro extends Controller
{
     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro_Usuario  $carro_Usuario
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $order = Order::findOrFail($request->order_id);
 
        // Ship the order...
 
        Mail::to($request->user())->send(new OrderShipped($order)); */
    }
}
