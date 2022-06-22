<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Pedido;
use App\Models\Peca;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class PedidosEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth', 'verified', 'company.user']);
    }


    public function index()
    {

        $empresas_usuario = User::find(Auth::user()->id)->empresas()->get()->toArray();

        $pedidos = Pedido::whereIn('id_empresa', (array_column($empresas_usuario, 'id')))
            ->orderByDesc('pedidos.id')
            ->paginate(10);

      return view('pedidosempresa.dashboard')->with('pedidos', $pedidos);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedidos_filial)
    {
        $pecas = Pedido::find($pedidos_filial->id)->pecas()->orderBy('nm_peca', 'ASC')->get();
        return view('pedidosempresa.show')->with('pedido', $pedidos_filial)->with('pecas', $pecas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedidos_filial)
    {
        //Mesma página do show.blade
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedidos_filial)
    {
        $request->request->add(['ck_finalizado' => 'S']);
        $pedidos_filial->update($request->all());
        return view('pedidosempresa.pagar')->with('pedido', $pedidos_filial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedidos_filial)
    {
    }
}
