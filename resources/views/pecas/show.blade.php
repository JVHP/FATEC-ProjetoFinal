@extends('master')

@section('body')
    <div class="card-display border-bottom-orange">
        <div class="row col-lg-12 col-md-12 col-sm-12 col-12 p-5 mx-auto">
            <div class="col-lg-3 col-md-5 col-sm-6 col-12 text-center pb-2 mx-md-auto mx-sm-auto mx-auto">
                @if ($peca->foto)
                    <img class="rounded" src="data:image/webp;base64, {{ stream_get_contents($peca->foto) }}"
                        width="300px" style="object-fit: cover;" alt="">
                @else
                    <?php
                    /*<img class="mx-auto" loading="lazy" src="{{Storage::disk('local')->url('/fotos/pecas/'.$fotos[0]->nm_armazenamento)}}" style="object-fit: cover; filter: grayscale(100%); opacity: 50%;" width="200px" alt="">*/
                    ?>
                    <img class="rounded" src="{{ URL('images/default.webp') }}" width="300px"
                        style="object-fit: cover;" alt="">
                @endif
            </div>
            <div class="card col-lg-7 col-md-12 col-sm-12 col-12 mx-auto ">
                <div class="row col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="col-8">

                        <div class="card-title">
                            <p class="pb-0 mb-0">Código: {{ $peca->id }}</p>
                            <p class="pb-0 mb-0">Categoria: {{ $tipoPeca->nm_tipo }}</p>
                            <h1>{{ $peca->nm_peca }}</h1>
                        </div>
                        <div class="card-body">
                            <dl class="h4">Á vista sai por
                                <dd class="h3 fw-bolder text-success">R$ {{ number_format($peca->vl_peca, 2, ',') }}</dd>
                                <dd class="h5">em até <span class="text-success">12x R$
                                        {{ number_format(round($peca->vl_peca / 12, 2), 2, ',') }}<span> sem juros!</dd>
                            </dl>
                            <div class="pt-4 my-auto">
                                @if ($peca->qt_estoque > 0)
                                    @guest
                                        <a href="/login">
                                            <button class="btn btn-primary">
                                                Comprar
                                            </button>
                                        </a>
                                    @else
                                        <form class="" action="/pedido" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="peca" value="{{ $peca->id }}">
                                            <input type="hidden" name="vl_peca" value="{{ $peca->vl_peca }}">
                                            <button type="submit" class="btn btn-primary">
                                                Comprar
                                            </button>
                                        </form>
                                    @endguest
                                @else
                                    <button disabled class="btn btn-primary">Indisponível</button>
                                @endif
                            </div>
                            <!--<div class="d-flex justify-content-center form-floating">
                        <input type="text" id="frete" class="form-control" placeholder="Calcular Frete" style="height: 1.5rem;">
                        <label for="frete" style="height: 1.5rem;">Calcular Frete</label>
                        <button class="btn btn-primary" style="height: 1.5rem;"></button>
                    </div>-->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 my-auto">

                    </div>
                </div>
            </div>
            {{-- <div class="pt-5">
            <hr class="pt-2 bg-orange" style="opacity: 100%;">
        </div> --}}
        </div>
    </div>
    <div class="card-display border-bottom-orange mt-3">
        <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Informações sobre o produto</h1>
        <div class="row mx-auto col-lg-12 col-md-12 col-sm-12 col-12 p-3">
            <div>
                <ul>
                    <div class="">
                        <div class="" style="height: 100%;">
                            <div>
                                <dl>
                                    <dd class="pb-0 mb-0">Marca: </dd>
                                    <dd>
                                        <b>{{ $peca->marca()->first()->nm_marca }}</b>
                                    </dd>
                                </dl>
                            </div>
                            <div>
                                <dl>
                                    <dd>Compatível com o(s) seguinte(s) carro(s):</dd>
                                    @forelse($carros as $xx)
                                        <dd class="fw-bold">{{ $xx->nm_carro }}</dd>
                                    @empty
                                        <dd class="fw-bold">Compatibilidade Universal</dd>
                                    @endforelse
                                </dl>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
@endsection
