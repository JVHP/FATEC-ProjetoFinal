@extends('master')

@section("body")
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/tiposcarro", "nm_pag" => "Tipos de Carro"],
    ["link"=>"", "nm_pag" => "Visualizar Tipo de Carro"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="mx-auto col-4">
    <div class="card-display border-bottom-orange">
        <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12" >Visualizar Tipo de Carro</h2>
        <form action="/tiposcarro/{{$tipo->id}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="card-title ps-2 pt-2 mb-0">
                <!-- <hr class="p-1 m-0 bg-primary col-lg-8 col-md-8 col-sm-12 col-md-6" style="opacity: 100%; padding-top: 0"> -->
            </div>
            <div class="card-body">
                <dl class="">
                    <dd class="h3 fw-bolder">{{$tipo->nm_tipo}}</dd>
                </dl>
                <a href="/tiposcarro"><button type="button" class="btn btn-primary">Voltar</button></a>
                <input class="btn btn-danger col-3" type="submit" value="Excluir">
            </div>
        </form>
    </div>
</div>
@endsection