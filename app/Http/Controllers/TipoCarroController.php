<?php

namespace App\Http\Controllers;

use App\Models\TipoCarro;
use Illuminate\Http\Request;

class TipoCarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['auth', 'company.user', 'verified']);
    }

    public function index()
    {
        $tipos = TipoCarro::orderBy('id', 'ASC')->paginate(10);
        return view('tiposcarro.indexAdm')->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tiposcarro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TipoCarro::create($request->all());
        return redirect('/tiposcarro');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoCarro  $tipoCarro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = TipoCarro::findOrFail($id);
        return view('tiposcarro.show')->with('tipo', $tipo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoCarro  $tipoCarro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo = TipoCarro::findOrFail($id);
        return view('tiposcarro.edit')->with('tipo', $tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoCarro  $tipoCarro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoCarro = TipoCarro::findOrFail($id);
        $tipoCarro->update($request->all());
        return redirect('/tiposcarro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoCarro  $tipoCarro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoCarro = TipoCarro::findOrFail($id);
        $tipoCarro->delete();
        return redirect('/tiposcarro');
    }
}
