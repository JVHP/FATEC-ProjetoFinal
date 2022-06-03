<?php

namespace App\Http\Controllers;

use App\Models\Peca;
use App\Models\Carro;
use App\Models\Foto_Peca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PecaRequest;
use App\Models\TipoPeca;
use App\Models\Marca;
use App\Models\Empresa;

class PecaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->middleware('client.user');
    }

    public function index()
    {   
        /* $pecas =
                DB::table('pecas')
                ->join('tipo_pecas', 'pecas.id_tipo_peca', '=', 'tipo_pecas.id')
                ->join('marcas', 'pecas.id_marca', '=', 'marcas.id')
                ->select('pecas.*', 'tipo_pecas.nm_tipo', 'marcas.nm_marca')
                ->orderBy('id', 'ASC')
                ->paginate(10);


        return view('pecas.indexAdm')->with('pecas', $pecas); */
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PecaRequest $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function show($cd_empresa, Peca $peca)
    {

        $empresa = Empresa::where('url_customizada', '=', $cd_empresa)->first();

        session(['empresa' => $empresa]);
       
        $carros = Peca::find($peca->id)->carros()->get();
        $tipoPeca = Peca::find($peca->id)->tipoPeca()->first();
        $marca = Marca::whereIn('ck_categoria_marca', ['P', 'A'])->get();

        
        if ($empresa == null || $peca->id_empresa != $empresa->id) {
            return redirect()->back();
        }
        
        return view('pecas.show')->with('peca', $peca)->with('carros', $carros)->with('tipoPeca', $tipoPeca)->with('marca', $marca);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function edit(Peca $peca)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function update(PecaRequest $request, Peca $peca)
    {
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peca $peca)
    {
        return redirect()->back();
    }
}
