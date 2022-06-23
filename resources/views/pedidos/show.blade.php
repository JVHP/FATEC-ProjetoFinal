@extends('master')

@section('body')
    @php
    $paginas = collect([['link' => '/loja/' . session('empresa')->url_customizada, 'nm_pag' => 'Início'], ['link' => '/pedidos', 'nm_pag' => 'Pedidos'], ['link' => '', 'nm_pag' => 'Visualizar Pedido']])->collect();
    @endphp

    <x-breadcrumb :paginas="$paginas" />
    <div class="mx-auto col-lg-5 col-md-7 col-sm-8 col-12 pb-5">
        <div class="card-display border-bottom-orange">
            <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Visualizar Pedido</h2>
            <form action="/loja/{{ session('empresa')->url_customizada }}/pedido/{{ $pedido->id }}" method="POST">
                <div class="card-title px-2 pt-2 mb-0">
                    <span class="badge @if ($pedido->dt_pagamento != null) bg-success @else bg-primary @endif">
                        {{ $pedido->dt_pagamento != null ? 'Pago em ' . date('d/m/Y', strtotime($pedido->dt_pagamento)) : 'Ainda não foi pago' }}
                    </span>
                </div>

                @csrf
                @METHOD('PUT')
                
                <div class="card m-2 p-2">
                    <dl class="">
                        <dd class="h3 fw-bolder">Pedido: {{ $pedido->id }}</dd>
                        @foreach ($pecas as $p)
                            <dd class="h4">
                                {{ $p->nm_peca }}: R$ {{ number_format($p->vl_peca, 2, ',') }}
                            </dd>
                        @endforeach
                        <hr>
                        <dd class="h4">Valor total: R$ {{ number_format($pedido->vl_preco_total, 2, ',') }}</dd>
                    </dl>
                </div>

                <div class="m-2 text-end">
                    <a href="/loja/{{ session('empresa')->url_customizada }}/usuario/pedidos"><button type="button"
                            class="btn btn-primary">Voltar</button></a>
                    @if (($pedido->ck_finalizado != 'N' && $pedido->dt_pagamento != null) || ($pedido->ck_finalizado == 'C' && $pedido->dt_pagamento == null))
                        <form action="/loja/{{ session('empresa')->url_customizada }}/pedido/{{ $pedido->id }}"
                            method="POST">
                            @csrf
                            @METHOD('DELETE')
                            <input type="submit" class="btn btn-danger" value="Excluir" />
                        </form>
                    @endif

                    {{-- Remover este método de identificação do ck_finalizado --}}

                    @if ($pedido->ck_finalizado[0] == 'N' && $pedido->dt_pagamento == null)
                        <input class="btn btn-success col-3" type="submit" value="Finalizar">

                        <a href="/loja/{{ session('empresa')->url_customizada }}/pedido/cancelar/{{ $pedido->id }}">
                            <button class="btn btn-danger" disabled>Cancelar</button>
                        </a>
                    @elseif($pedido->ck_finalizado == 'S' && $pedido->dt_pagamento == null)
                        <a href="/loja/{{ session('empresa')->url_customizada }}/pedido/pagar/{{ $p->id }}"><button
                                type="button" class="btn btn-info">Pagar</button></a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
