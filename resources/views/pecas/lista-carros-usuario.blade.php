@extends('master')
@section('body')
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Início"], 
    ["link"=>"", "nm_pag" => "Peças para seu(s) carro(s)"],
])->collect();
@endphp


<x-breadcrumb :paginas="$paginas" />
    <div class="card-display border-bottom-orange">
        <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Peças para seu(s) carro(s)</h1>
        <div class="row mx-auto col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
            @if(sizeOf($varPeca) == 0)
                <div class="p-2">
                    <div class="card p-3">
                        @if($mensagem != '')
                        <div class="row text-center mb-4">
                            <img class="col-md-3 col-12 m-3" src="{{URL::asset('icons/undraw_not_found_-60-pq.svg')}}" class="img-fluid" alt="" style="width: 21%">
                            <h1 class="col-md-9 col-12 my-auto">
                                {{$mensagem}}
                            </h1>
                        </div>
                        @else
                        <div class="row text-center mb-4">
                            <img class="col-md-3 col-12 m-3" src="{{URL::asset('icons/undraw_not_found_-60-pq.svg')}}" class="img-fluid" alt="" style="width: 21%">
                            <h1 class="col-md-9 col-12 my-auto">
                                Não foram encontrados carros vinculados ao seu usuário
                            </h1>
                        </div>
                        @endif                        
                    </div>
                </div>
            @else
            @foreach($varPeca as $x)
            <div class="pt-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mx-auto" style="width: 20.19rem;">
                <div class="card rounded">
                    @if($x->qt_estoque > 0)
                    @if($x->foto)
                    <div class="col-12 text-center bg-white">
                        <img class="img-zoom" loading="lazy" src="data:image/webp;base64, {{stream_get_contents($x->foto)}}" width="200px" height="200px" style="" alt="">
                    </div>
                    @else
                    <div class="col-12 text-center" style=" background: #f3f4f6">
                        <img class="rounded " src="{{URL('images/default.webp')}}" width="200px" height="200px" style="object-fit: cover;" alt="">
                    </div>
                    @endif
                    <div class="card-body" id="peca{{$x->id}}" style="height: 10rem; /* overflow: auto; */" style="transition: 1s all ease">
                        <div class="card-title">
                            <h5 class="fw-bold col-auto text-truncate mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$x->nm_peca}}">{{ $x->nm_peca }}</h5> 
                            <div class="d-flex gap-1 text-truncate" z-index="4" id="carrosPeca{{$x->id}}" onclick="exibirTodosCarrosPeca({{$x->id}})">
                                @foreach($varCarro as $carro)
                                    @if($carro->peca_id == $x->id)
                                        <span class="badge rounded-pill bg-secondary">{{$carro->nm_carro.'-'.$carro->ano}}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <dl>
                            <dd><span class="text-success">à vista</span>
                                <p>R$ {{ number_format($x->vl_peca, 2, ',') }}</p>
                            </dd>
                            <dd>12x R$ {{ number_format(round($x->vl_peca / 12, 2), 2, ',') }} sem juros</dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-white text-center" style="border: none;">
                        <a href="/loja/{{session('empresa')->url_customizada}}/pecas/{{$x->id}}">
                            <button type="button" class=" col-12 btn btn-outline-primary">
                                <div class="row col-12 justify-content-between fw-bolder">
                                    <div class="col-2">
                                        <i class="bi bi-cart"></i>        
                                    </div>
                                    <div class="col-10 text-center">
                                        Visualizar        
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                    @else
                    @if($x->foto)
                    <div class="col-12 text-center ">
                        <img class="mx-auto img-zoom" loading="lazy" src="data:image/webp;base64, {{stream_get_contents($x->foto)}}" width="200px" height="200px" style="object-fit: cover; filter: grayscale(100%); opacity: 50%;" alt="">
                    </div>
                    @else
                    <div class="col-12 text-center" style=" background: #f3f4f6">
                        <img class="rounded img-fluid" src="{{URL('images/default.webp')}}" width="200px" height="200px" style="object-fit: cover;" alt="">
                    </div>
                    @endif
                    <div class="card-body" id="peca{{$x->id}}" style="height: 10rem; /* overflow: auto; */" style="transition: 1s all ease">
                        <div class="card-title">
                            <h5 class="fw-bold col-auto text-truncate mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$x->nm_peca}}">{{ $x->nm_peca }}</h5> 
                            <div class="d-flex gap-1 text-truncate" z-index="4" id="carrosPeca{{$x->id}}" onclick="exibirTodosCarrosPeca({{$x->id}})">
                                @foreach($varCarro as $carro)
                                    @if($carro->peca_id == $x->id)
                                        <span class="badge rounded-pill bg-secondary">{{$carro->nm_carro.'-'.$carro->ano}}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <dl>
                            <dd><span class="text-success">à vista</span>
                                <p>R$ {{ number_format($x->vl_peca, 2, ',') }}</p>
                            </dd>
                            <dd>12x R$ {{ number_format(round($x->vl_peca / 12, 2), 2, ',') }} sem juros</dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-white text-center" style="border: none;"><button type="button" class="col-12 btn btn-primary disabled">Indisponível</button></div>
                    @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
<div class="d-flex justify-content-center align-end pt-3">
    {{ $varPeca->onEachSide(5)->links() }}
</div>


@endsection