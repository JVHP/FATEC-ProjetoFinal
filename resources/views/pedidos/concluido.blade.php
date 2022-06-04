@extends('master')

@section("body")
@php
$paginas = collect([
    ["link"=>"/loja/".session("empresa")->url_customizada, "nm_pag" => "Início"], 
    ["link"=>"/pedidos", "nm_pag" => "Pagamento"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />

<div class="card-display border-bottom-orange" >
    <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Pagamento - {{$message['titulo']}}</h2>
    <div class="card-body  p-3">
        <div>
            @if($message['titulo'] == "Sucesso")
            <div class="text-center mb-4">
                <img src="{{URL::asset('icons/undraw_successful_purchase_re_mpig.svg')}}" class="img-fluid" alt="" style="width: 21%">
            </div>

            <h2 class="text-center">{{$message['corpo']}}</h2>

            <hr>
            <h4 class="text-center">

                Seu pedido será entregue dentre alguns dias!

            </h4>
            @else
            <div class="text-center mb-4">
                <img src="{{URL::asset('icons/undraw_warning_re_eoyh.svg')}}" class="img-fluid" alt="" style="width: 21%">
            </div>
            <h2 class="text-center">{{$message['corpo']}}</h2>

            @endif
        </div>
        <div>
        </div>
    </div>
</div>

@endsection

