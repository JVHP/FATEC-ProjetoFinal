<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoCarroRequest;
use App\Models\TipoCarro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $empresas_usuario = User::find(Auth::user()->id)->empresas()->get()->toArray();

        $tipos = TipoCarro::whereIn('tipo_carros.id_empresa', (array_column($empresas_usuario, 'id')))->paginate(15);
        return view('tiposcarro.indexAdm')->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $empresas_usuario = User::find(Auth::user()->id)->empresas()->get();

        return view('tiposcarro.create')->with("empresas", $empresas_usuario);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoCarroRequest $request)
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
        
        $empresas_usuario = User::find(Auth::user()->id)->empresas()->get();

        return view('tiposcarro.edit')->with('tipo', $tipo)->with("empresas", $empresas_usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoCarro  $tipoCarro
     * @return \Illuminate\Http\Response
     */
    public function update(TipoCarroRequest $request, $id)
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
