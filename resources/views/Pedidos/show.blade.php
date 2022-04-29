@extends('master')

@section("body")
<div class="mx-auto col-4 pt-5 pb-5">
    <div class="card">
        <form action="/pedido/{{$pedido->id}}" method="POST">
            @csrf
            @METHOD('PUT')
            <div class="card-title ps-2 pt-2 mb-0">
                <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-8 col-md-8 col-sm-12 col-12" >Visualizar Pedido</h2>
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
                <a href="/dashboard"><button type="button" class="btn btn-primary">Voltar</button></a>
                @if(($pedido->ck_finalizado != 'N' && $pedido->dt_pagamento != null) || ($pedido->ck_finalizado == 'C' && $pedido->dt_pagamento == null))
                    <form action="/pedido/{{$pedido->id}}" method="POST">
                        @csrf
                        @METHOD('DELETE')
                        <input type="submit" class="btn btn-danger" value="Excluir"/>
                    </form>
                @endif

                    {{-- Remover este método de identificação do ck_finalizado --}}

                @if($pedido->ck_finalizado[0] == 'N' && $pedido->dt_pagamento == null)
                    <input class="btn btn-success col-3" type="submit" value="Finalizar">
                    
                    <a href="/pedido/cancelar/{{$pedido->id}}">
                        <button class="btn btn-warning" disabled>Cancelar</button>
                    </a>
                    
                @elseif($pedido->ck_finalizado == 'S' && $pedido->dt_pagamento == null )
                    <a href="pedido/pagar/{{$p->id}}"><button type="button" class="btn btn-info">Pagar</button></a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection