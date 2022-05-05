@extends('master')

@section("body")
<div class="mx-auto col-lg-5 col-md-7 col-sm-8 col-12 pt-5">
    <div class="card border-bottom-orange">
        <form action="/carros/{{$carro->id}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="card-title ps-2 pt-2 mb-0">
                <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-8 col-md-8 col-sm-12 col-12" >Visualizar Carro</h2>
                <!-- <hr class="p-1 m-0 bg-primary col-lg-6 col-md-3 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
            </div>
            <div class="card-body">
                <dl class="">
                    <dd class="h3 fw-bolder">{{$carro->nm_carro}}</dd>
                    @foreach($tipo as $x)
                    @if($x->id == $carro->id_tipo_carro)
                    <dd class="h5">Categoria {{$x->nm_tipo}}</dd>
                    @endif
                    @endforeach
                    <dd class="h5">Ano {{$carro->ano}}</dd>
                </dl>
                <a href="/carros"><button type="button" class="btn btn-primary">Voltar</button></a>
                <input class="btn btn-danger col-3" type="submit" value="Excluir">
            </div>
        </form>
    </div>
</div>
@endsection