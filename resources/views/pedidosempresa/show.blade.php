@extends('master')

@section("body")
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/pedidos-filial", "nm_pag" => "Pedidos de suas filiais"],
    ["link"=>"", "nm_pag" => "Visualizar Pedido"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="mx-auto col-lg-5 col-md-7 col-sm-8 col-12 pb-5">
    <div class="card-display border-bottom-orange">
        <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Visualizar Pedido</h2>
        <form action="/pedido-filial/enviar/{{$pedido->id}}" method="POST">
            @csrf
            @METHOD('PUT')
            <div class="card-title px-2 pt-2 mb-0">
                <span class="badge @if($pedido->dt_pagamento != null) bg-success @else bg-primary @endif">
                    {{$pedido->dt_pagamento != null ? 'Pago em '.date('d/m/Y', strtotime($pedido->dt_pagamento)) : 'Ainda não foi pago'}}
                </span>
                <!-- <hr class="p-1 m-0 bg-primary col-xl-7 col-lg-9 col-md-11 col-sm-11" style="opacity: 100%; padding-top: 0"> -->
            </div>
            <div class="card-body">
                <dl class="">
                    <dd class="h3 fw-bolder">Pedido: {{$pedido->id}}</dd>
                    @foreach($pecas as $p)
                    <dd class="h4">
                        {{$p->nm_peca}}: R$ {{number_format($p->vl_peca, 2, ',')}}
                    </dd>
                    @endforeach
                    <hr>
                    <dd class="h4">Valor total: R$ {{number_format($pedido->vl_preco_total, 2, ',')}}</dd>
                </dl>
                <a href="/pedidos-filial/"><button type="button" class="btn btn-primary">Voltar</button></a>

                @if($pedido->ck_finalizado == 'S' && $pedido->dt_pagamento != null )
                    <button type="button" class="btn btn-info">Enviar</button>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection