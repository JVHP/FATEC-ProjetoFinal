@extends('master')

@section('body')
<form action="/pecas/{{$peca->id}}" method="POST">
    @csrf
    @method('DELETE')
    <div class="row col-lg-12 col-md-12 col-sm-12 col-12 p-5">
        <div class="col-lg-3 col-md-5 col-sm-6 col-12 text-center pb-2 mx-md-auto mx-sm-auto mx-auto">
            @if($peca->foto)
            <img class="rounded" src="data:image/webp;base64, {{stream_get_contents($peca->foto)}}" width="300px" style="object-fit: cover;" alt="">
            @else
            <?php
            /*<img class="mx-auto" loading="lazy" src="{{Storage::disk('local')->url('/fotos/pecas/'.$fotos[0]->nm_armazenamento)}}" style="object-fit: cover; filter: grayscale(100%); opacity: 50%;" width="200px" alt="">*/
            ?>
            <img class="rounded" src="{{URL('images/default.webp')}}" width="300px" style="object-fit: cover;" alt="">
            @endif
        </div>
        <div class="card-display border-bottom-orange col-lg-7 col-md-12 col-sm-12 col-12 mx-auto ">
            <div class="row col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="col-8">

                    <div class="card-title">
                        <p class="pb-0 mb-0">Código: {{$peca->id}}</p>
                        <h1>{{$peca->nm_peca}}</h1>
                    </div>
                    <div class="card-body">
                        <dl class="h4">Preço Bruto
                            <dd class="h3 fw-bolder">R$ {{ number_format($peca->vl_peca, 2, ',') }}</dd>
                        </dl>
                        <div class="pt-3">
                            <h3>Informações adicionais:</h3>
                            <div>

                                <div>
                                    <dl>
                                        <dd>Compatível com o(s) seguinte(s) carro(s):</dd>
                                        @forelse($carros as $xx)
                                        <dd class="fw-bold">{{$xx->nm_carro}}</dd>
                                        @empty
                                        <dd class="fw-bold">Compatibilidade Universal</dd>
                                        @endforelse
                                    </dl>
                                </div>
                            </div>
                            <div class="pt-3">
                                <a href="/pecas"><button type="button" class="btn btn-primary">Voltar</button></a>
                                <input type="submit" class="btn btn-danger" value="Deletar">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection