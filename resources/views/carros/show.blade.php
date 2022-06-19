@extends('master')

@section('body')@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/carros", "nm_pag" => "Carros"],
    ["link"=>"", "nm_pag" => "Visualizar Carro"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
    <div class="mx-auto col-lg-5 col-md-7 col-sm-8 col-12">
        <div class="card-display border-bottom-orange">
            <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Visualizar Carro</h2>
            <div class="p-3">
                @if (isset($message))
                    <div class="alert alert-danger">{{ $message }}</div>
                @endif
                <form action="/carros/{{ $carro->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="card-body">
                        <dl class="">
                            <dd class="h3 fw-bolder">{{ $carro->nm_carro }}</dd>
                            @foreach ($tipo as $x)
                                @if ($x->id == $carro->id_tipo_carro)
                                    <dd class="h5">Categoria: {{ $x->nm_tipo }}</dd>
                                @endif
                            @endforeach
                            <dd class="h5">Filial: {{ $carro->filial()->first()->razao_social }}</dd>
                            <dd class="h5">Marca: {{ $carro->marca()->first()->nm_marca }}</td>
                            <dd class="h5">Ano: {{ $carro->ano }}</dd>
                        </dl>
                        <a href="/carros"><button type="button" class="btn btn-primary">Voltar</button></a>
                        <input class="btn btn-danger col-3" type="submit" value="Excluir">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
