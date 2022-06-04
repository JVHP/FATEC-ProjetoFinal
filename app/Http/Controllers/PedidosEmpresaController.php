<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Peca;
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
        $pedidos = DB::table('pedidos')
            ->join('empresas_usuarios', 'empresas_usuarios.id_empresa', '=', 'pedidos.id_empresa')
            ->select('pedidos.*')
            ->where('empresas_usuarios.id_usuario', '=', Auth::user()->id)
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
    public function show(Pedido $pedido)
    {
        $pecas = Pedido::find($pedido->id)->pecas()->orderBy('nm_peca', 'ASC')->get();
        return view('pedidos.show')->with('pedido', $pedido)->with('pecas', $pecas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
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
    public function update(Request $request, Pedido $pedido)
    {
        $request->request->add(['ck_finalizado' => 'S']);
        $pedido->update($request->all());
        return view('pedidos.pagar')->with('pedido', $pedido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {        
        $pedido->pecas()-> detach();
        $pedido->delete();
        
        return redirect('/dashboard');
    }
}
