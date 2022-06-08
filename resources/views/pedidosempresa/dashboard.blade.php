@extends('master')

@section("body")
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/pedidos", "nm_pag" => "Pedidos de suas filiais"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="card-display border-bottom-orange">
    <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Pedidos de suas filiais</h1>
    
    <div class="pt-3 table-responsive p-2">
        @if(sizeof($pedidos) > 0)
        <table class="rounded table table-hover">
            <thead class="bg-primary-dark text-white">
                <tr>
                    <th class="m-0 text-center">Id</th>
                    <th class="m-0 text-center">Data do Pedido</th>
                    <th class="m-0 text-center">Total</th>
                    <th class="m-0 text-center">Status</th>
                    <th class="m-0 text-center">Data do Pagamento</th>
                    <th class="m-0 text-center">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($pedidos as $x)
                <tr>
                    <td class="m-0 text-center">{{$x->id}}</td>
                    <td class="m-0 text-center">{{$x->dt_pedido == null ? '' : date('d/m/Y', strtotime($x->dt_pedido))}}</td>
                    <td class="m-0 text-center">R$ {{number_format($x->vl_preco_total, 2, ',')}}</td>
                    <td class="m-0 text-center">{{$x->ck_finalizado == 'S' ? 'Finalizado' : ($x->ck_finalizado == 'N' ? 'Não Finalizado' : ($x->ck_finalizado == 'C' ? 'Cancelado' : ($x->ck_finalizado == 'E' ? 'Enviado' : '')))}}</td>
                    <td class="m-0 text-center">{{$x->dt_pagamento == null ? '' : date('d/m/Y', strtotime($x->dt_pagamento))}}</td>
                    <td class="m-0 text-center">
                        <div class="justify-content-center row col-auto">                        
                        @if($x->ck_finalizado == 'S' && $x->dt_pagamento != null)
                        <form action="/pedidos-filial/enviar/{{$x->id}}" method="POST" class="col-auto">
                            @method("PUT")
                            @csrf
                            <input type="submit" class="btn btn-outline-info" value="Enviar"/>
                        </form>                                  
                        {{-- @elseif($x->ck_finalizado == 'N' && $x->dt_pagamento == null)
                        <a href="/pedidos-filial/{{$x->id}}" class="col-auto">
                            <button class="btn btn-outline-warning">Cancelar</button>
                        </a> --}}
                        @endif
                            <a href="/pedidos-filial/{{$x->id}}" class="col-auto">
                                <button class="btn btn-outline-success">Visualizar</button>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center align-end">
            {{ $pedidos->onEachSide(5)->links() }}
        </div>
        @else
        <div class="p-2">
            <div class="card" style="">
                <div class="row text-center mb-4">
                    <img class="col-md-3 col-12 m-3" src="{{URL::asset('icons/undraw_not_found_-60-pq.svg')}}" class="img-fluid" alt="" style="width: 21%">
                    <h1  class="col-md-auto col-12 my-auto">
                        Não foi realizado nenhum pedido
                    </h1>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection