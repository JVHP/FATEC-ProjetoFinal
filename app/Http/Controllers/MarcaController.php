<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\MarcaRequest;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Nette\Utils\Arrays;

class MarcaController extends Controller
{

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
        $marcas = Marca::orderBy('id', 'asc')->paginate(15);
        return view('marcas.indexAdm')->with('marcas', $marcas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaRequest $request)
    {
        Marca::create($request->all());
        return redirect('/marcas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //TODO
        return view('marcas.show')->with('marca', $marca);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit')->with('marca', $marca);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request, Marca $marca)
    {
        Validator::make($request->rules(), [
            'nm_marca' => [
                'required', 
                Rule::unique('marcas')->ignore($marca->id),
            ],
        ]);

        if ($request->ck_categoria_marca != $marca->ck_categoria_marca) {
            $vinculados = $marca->vinculados();

            if (sizeof($vinculados) > 0) {

                $message = "A categoria da marca não pode ser alterada pois existem ";
    
                switch($marca->ck_categoria_marca) {
                    case 'P':
                        $message += "Peça(s)";
                        break;
                    case 'C':
                        $message += "Carro(s)";
                        break;
                    case 'A':
                        $message += "Peça(s)/Carro(s)";
                        break;
                    default:
                        $message += "dados";
                        break;
                }

                return view('marcas.edit')->with('marca', $marca)->with('message', " vinculados a ela.");
            }
        }


        $marca->update($request->all());

        return redirect('/marcas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $vinculados = $marca->vinculados();

        if (sizeof($vinculados) > 0) {
            $message = "A categoria da marca não pode ser alterada pois existem ";
    
            switch($marca->ck_categoria_marca) {
                case 'P':
                    $message += "Peça(s)";
                    break;
                case 'C':
                    $message += "Carro(s)";
                    break;
                case 'A':
                    $message += "Peça(s)/Carro(s)";
                    break;
                default:
                    $message += "dados";
                    break;
            }
            
            return view('marcas.show')->with('marca', $marca)->with('message', "vinculados a ela.");
        }

        $marca->delete();
        return redirect('/marcas');
    }
}
