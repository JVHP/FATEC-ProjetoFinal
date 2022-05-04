@extends('master')
@section('body')

<div class="pt-5">
    <div class="card">
    <div class="p-2">
        <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-2 col-md-2 col-sm-12 col-12" >Peças</h1>
    </div>
        <div class="row mx-auto col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pb-5">
            @foreach($varPeca as $x)
            <div class=" pt-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12" style="width: 20.19rem;">
                <div class="card rounded">
                    @if($x->qt_estoque > 0)
                    @if($x->foto)
                    <div class="col-12 text-center">
                        <img class=" " loading="lazy" src="data:image/png;base64, {{stream_get_contents($x->foto)}}" style="object-fit: cover;" width="200px" height="200px" alt="">
                    </div>
                    @else
                    <div class="col-12 text-center" style=" background: #f3f4f6">
                        <img class="rounded " src="{{URL('images/default.png')}}" width="200px" height="200px" style="object-fit: cover;" alt="">
                    </div>
                    @endif
                    <div class="card-body" style="height: 150px; /* overflow: auto; */">
                        <div class="card-title">
                            <h5 class="fw-bold col-auto text-truncate" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$x->nm_peca}}">{{ $x->nm_peca }}</h5>
                        </div>
                        <dl>
                            <dd><span class="text-success">à vista</span>
                                <p>R$ {{ number_format($x->vl_peca, 2, ',') }}</p>
                            </dd>
                            <dd>12x R$ {{ number_format(round($x->vl_peca / 12, 2), 2, ',') }}</dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-white text-center" style="border: none;"><a href="/pecas/{{$x->id}}"><button type="button" class="col-12 btn btn-primary">comprar</button></a></div>
                    @else
                    @if($x->foto)
                    <div class="col-12 text-center">
                        <img class="mx-auto" loading="lazy" src="data:image/png;base64, {{stream_get_contents($x->foto)}}" style="object-fit: cover; filter: grayscale(100%); opacity: 50%;" width="200px" height="200px" alt="">
                    </div>
                    @else
                    <div class="col-12 text-center" style=" background: #f3f4f6">
                        <img class="rounded img-fluid" src="{{URL('images/default.png')}}" width="200px" height="200px" style="object-fit: cover;" alt="">
                    </div>
                    @endif
                    <div class="card-body text-secondary" style="height: 150px/* ; overflow: auto; */">
                        <div class="card-title">
                            <h5 class="fw-bold col-auto text-truncate" data-bs-toggle="tooltip" data-bs-placement="right" title="{{$x->nm_peca}}">{{ $x->nm_peca }} </h5>
                        </div>
                        <dl>
                            <dd>R$ {{ number_format($x->vl_peca, 2, ',') }}</dd>
                            <dd>12x R$ {{ number_format(round($x->vl_peca / 12, 2), 2, ',') }}</dd>
                        </dl>
                    </div>
                    <div class="card-footer bg-white text-center" style="border: none;"><button type="button" class="col-12 btn btn-primary disabled">Indisponível</button></div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="d-flex justify-content-center align-end pt-3">
    {{ $varPeca->onEachSide(5)->links() }}
</div>


@endsection