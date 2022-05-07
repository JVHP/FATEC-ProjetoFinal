<?php

namespace App\Http\Controllers;

use App\Models\Carro_Usuario;
use Illuminate\Http\Request;

class CarroUsuarioController extends Controller
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
        $carro_usuario = Carro_Usuario::create($request->all());
        return $carro_usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro_Usuario  $carro_Usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Carro_Usuario $carro_Usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carro_Usuario  $carro_Usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Carro_Usuario $carro_Usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carro_Usuario  $carro_Usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carro_Usuario $carro_Usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro_Usuario  $carro_Usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carro_Usuario $carro_Usuario)
    {
        //
    }
}
