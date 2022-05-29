@extends('master')

@section('banner')
    <div class="banner col-lg-12 col-md-12 col-sm-12 col-12" style=""></div>

    <h1 class="col-12 text-center mx-auto fw-bold text-white titulo-banner">
        @if(session('cd_empresa')) 
            {{session('cd_empresa')}}
        @else
            iTURBO
        @endif
    </h1>
@endsection

@section('body')
    <div class="welcome-padding-top">
        <div class="card-display border-bottom-orange pb-2">
            <h1 class="rounded border-bottom-orange bg-primary-dark text-white p-2 col-12">Destaques</h1>
            <div class="owl-carousel owl-theme">
                @foreach($varPeca as $x)
                <div class="item card rounded">
                    <!-- Cards para estoque disponível -->
                    @if($x->qt_estoque > 0)
                    @if($x->foto)
                    <div class="col-12 text-center">
                        <img class="mx-auto img-zoom" loading="lazy" src="data:image/webp;base64, {{stream_get_contents($x->foto)}}" width="200px" height="200px" alt=""> 
                    </div>
                    @else
                        <img class="rounded" src="{{URL('images/default.webp')}}" width="200px" height="200px" style="object-fit: cover;" alt="">
                    @endif
                    <div class="card-body" style="height: 150px; /* overflow: auto; */">
                        <div class="card-title">
                            <h5 class="fw-bold col-auto text-truncate" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$x->nm_peca}}">{{ $x->nm_peca }}</h5>
                        </div>
                        <dl>
                            <dd><span class="text-success">à vista</span>
                                <p>R$ {{ number_format($x->vl_peca, 2, ',') }}</p>
                            </dd>
                            <dd>12x R$ {{ number_format(round($x->vl_peca / 12, 2), 2, ',') }} sem juros</dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-white text-center" style="border: none;">
                            <a href="pecas/{{$x->id}}">
                                <button type="button" class=" col-12 btn btn-outline-primary">
                                    <div class="row col-12 justify-content-between fw-bolder">
                                        <div class="col-2">
                                            <i class="bi bi-cart"></i>        
                                        </div>
                                        <div class="col-10 text-center">
                                            Comprar        
                                        </div>
                                    </div>
                                </button>
                            </a>
                    </div>
                    @else
                    <!-- Cards para estoque indisponível -->
                    @if($x->foto)
                    <div class="col-12 text-center">
                        <img class="mx-auto img-zoom out-stock" loading="lazy" src="data:image/webp;base64, {{stream_get_contents($x->foto)}}" alt="" width="200px" height="200px">
                    </div>
                    @else
                        <img class="rounded" src="{{URL('images/default.webp')}}"  width="200px" height="200px" style="object-fit: cover;" alt="">
                    @endif
                    <div class="card-body text-secondary" style="height: 150px; overflow: auto;">
                        <div class="card-title">
                            <h5 class="fw-bold col-auto text-truncate" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$x->nm_peca}}">{{ $x->nm_peca }} </h5>
                        </div>
                        <dl>
                            <dd><span class="text-success">à vista</span>
                                <p>R$ {{ number_format($x->vl_peca, 2, ',') }}</p></dd>
                            <dd>12x R$ {{ number_format(round($x->vl_peca / 12, 2), 2, ',') }} sem juros</dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-white text-center" style="border: none;"><button type="button" class="col-12 btn-outline-primary disabled">Indisponível</button></div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection