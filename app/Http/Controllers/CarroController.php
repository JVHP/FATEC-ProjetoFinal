<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\TipoCarro;
use App\Models\Marca;
use Illuminate\Http\Request;
use App\Http\Requests\CarroRequest;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'company.user', 'verified']);
    }

    public function index()
    {
        $carros = Carro::orderBy('id', 'ASC')->paginate(10);
        return view('carros.indexAdm')->with('carros', $carros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposCarro = TipoCarro::all();
        $marcas = Marca::whereIn('ck_categoria_marca', ['C', 'A'])->get();
        return view('carros.create')->with('tipos', $tiposCarro)->with('marcas', $marcas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarroRequest $request)
    {
        Carro::create($request->all());
        return redirect('/carros');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show(Carro $carro)
    {
        $tipo = TipoCarro::all();
        $marcas = Marca::whereIn('ck_categoria_marca', ['C', 'A'])->get();
        return view('carros.show')->with('carro', $carro)->with('tipo', $tipo)->with('marcas', $marcas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function edit(Carro $carro)
    {
        $tipo = TipoCarro::all();
        $marcas = Marca::whereIn('ck_categoria_marca', ['C', 'A'])->get();
        $marcaCarro = $carro->marca()->first();
       
        return view('carros.edit')->with('carro', $carro)->with('tipo', $tipo)->with('marcas', $marcas)->with('marcaCarro', $marcaCarro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(CarroRequest $request, Carro $carro)
    {
        $carro->update($request->all());
        return redirect('/carros');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carro $carro)
    {

        if (sizeof($carro->pecas()->get())) {
            $tipo = TipoCarro::all();
            $marcas = Marca::whereIn('ck_categoria_marca', ['C', 'A'])->get();

            return view('carros.show')
                ->with('carro', $carro)
                ->with('tipo', $tipo)
                ->with('marcas', $marcas)
                ->with('message', 'Não é possível excluír carro, pois contém peças vinculadas a ele.');
        }

        /* $carro->pecas()->detach(); */
        $carro->delete();
        return redirect('/carros');
    }
}
