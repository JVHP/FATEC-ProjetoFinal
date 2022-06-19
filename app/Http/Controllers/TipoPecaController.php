<?php

namespace App\Http\Controllers;

use App\Models\TipoPeca;
use Illuminate\Http\Request;
use App\Http\Requests\TipoPecaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TipoPecaController extends Controller
{

    /*
    * Somente Administradores podem acessar
    */
    public function __construct() {
        $this->middleware(['auth', 'company.user', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas_usuario = User::find(Auth::user()->id)->empresas()->get()->toArray();

        $tipos = TipoPeca::whereIn('tipo_pecas.id_empresa', (array_column($empresas_usuario, 'id')))->paginate(15);
        return view('tipospeca.indexAdm')->with('tipos', $tipos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas_usuario = User::find(Auth::user()->id)->empresas()->get()->toArray();
            
        return view('tipospeca.create')->with('empresas', $empresas_usuario);
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
        $empresas = DB::table("empresas")
            ->join("empresas_usuarios", 'empresas_usuarios.id_empresa', '=', 'empresas.id')
            ->where('empresas_usuarios.id_usuario', '=', Auth::user()->id)
            ->select('empresas.*')
            ->get();    

        return view('tipospeca.edit')->with('tipo', $tipoPeca)->with('empresas', $empresas);
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
        return redirect('/tipospeca');
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
            $tipoPeca->delete();
        }

        return redirect('/tipospeca');
    }
}
