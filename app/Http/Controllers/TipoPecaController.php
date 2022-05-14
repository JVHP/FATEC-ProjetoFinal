<?php

namespace App\Http\Controllers;

use App\Models\TipoPeca;
use Illuminate\Http\Request;
use App\Http\Requests\TipoPecaRequest;

class TipoPecaController extends Controller
{

    /*
    * Somente Administradores podem acessar
    */
    public function __construct() {
        $this->middleware(['auth', 'admin.user']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoPeca::orderBy('id', 'ASC')->paginate(10);
        return view('tipospeca.indexAdm')->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipospeca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoPecaRequest $request)
    {
        if ($request->ck_ativo == 'off') {
            $request->request->add(['ck_ativo' => '0']);
        } else if ($request->ck_ativo == 'on') {
            $request->request->add(['ck_ativo' => '1']);
        }

        TipoPeca::create($request->all());
        return redirect('/tipospeca');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoPeca  $tipoPeca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoPeca = TipoPeca::findOrFail($id);
        return view('tipospeca.show')->with('tipo', $tipoPeca);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoPeca  $tipoPeca
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoPeca = TipoPeca::findOrFail($id);
        return view('tipospeca.edit')->with('tipo', $tipoPeca);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoPeca  $tipoPeca
     * @return \Illuminate\Http\Response
     */
    public function update(TipoPecaRequest $request, $id)
    {
        $tipoPeca = TipoPeca::findOrFail($id);

        if (!$request->has('ck_ativo')) {
            $pecas = $tipoPeca->pecas()->select('pecas.id')->get();

            if (sizeof($pecas) > 0) {
                
                return view('tipospeca.edit')->with('tipo', $tipoPeca)->with('message', "Não é possível desativar o tipo pois existem peças vinculadas à ele.");
            }

            $request->request->add(['ck_ativo' => '0']);

        } else if ($request->ck_ativo == 'on') {
            $request->request->add(['ck_ativo' => '1']);

        }

        $tipoPeca->update($request->all());
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoPeca  $tipoPeca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoPeca = TipoPeca::findOrFail($id);

        $pecas = $tipoPeca->find()->pecas()->get();

        if (sizeof($pecas) > 0) {
            return TipoPeca::show($tipoPeca)->with('message', "Não é possível excluír o tipo pois existem peças vinculadas.");
        } else {
            $tipo->delete();
        }

        return redirect('/tipospeca');
    }
}
