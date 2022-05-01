<?php

namespace App\Http\Controllers;

use App\Models\Peca;
use App\Models\Carro;
use App\Models\Foto_Peca;
use Illuminate\Http\Request;
use App\Http\Requests\PecaRequest;

class PecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->middleware('admin.user', ['except' => ['show']]);
    }

    public function index()
    {   
        $pecas = Peca::paginate(10);
        return view('pecas.indexAdm')->with('pecas', $pecas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carros = Carro::all();
        return view('pecas.create')->with('carros', $carros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PecaRequest $request)
    {
        if($request->has('fotoTemp')){
            $fotoB64 = base64_encode(file_get_contents($request->file('fotoTemp')->path()));
            $request->request->add(['foto' => $fotoB64]);

        }

        if($request->has('carros')){
            $carros = $request->carros;
            $peca = Peca::create($request->all());
            
            foreach($carros as $x){
                Carro::find($x)->pecas()->save($peca);
            } 
        } else {
            Peca::create($request->all());
        }
        
        /* Peca::create($request->all());*/
        return redirect('/pecas'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function show(Peca $peca)
    {
        $carros = Peca::find($peca->id)->carros()->get();
        return view('pecas.show')->with('peca', $peca)->with('carros', $carros)/* ->with('fotos', $peca->fotos()->get()) */;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function edit(Peca $peca)
    {
        $carros = Carro::all();
        $carrosPeca = Peca::find($peca->id)->carros()->get();
        return view('pecas.edit')->with('peca', $peca)->with('carros', $carros)->with('carrosPeca', $carrosPeca);
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
        if($request->has('fotoTemp')){
            $fotoB64 = base64_encode(file_get_contents($request->file('fotoTemp')->path()));
            $request->request->add(['foto' => $fotoB64]);
        
        }

        if($request->has('carros')){
            $carros = $request->carros;
                
            $peca->carros()->sync($carros);
            /* foreach($carros as $x){
                Carro::find($x)->pecas()->sync($peca);
            } */ 
        }

        $peca->update($request->all());
        return redirect('/pecas');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peca $peca)
    {
        $peca->carros()->detach();
        $peca->delete();
        return redirect('/pecas');
    }

    /* public function foto($id)
    {
        return view('peca.foto')->with('id', $id);
    } */
}
