@extends('master')

@section('body')
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/marcas", "nm_pag" => "Marcas"],
    ["link"=>"", "nm_pag" => "Visualizar Marca"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="mx-auto col-4">
    <div class="card-display border-bottom-orange">
        <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12" >Visualizar Marca</h2>
        <form action="/tiposcarro/{{$marca->id}}" method="POST">
            @csrf
            @method('DELETE')
            @if(isset($message))
            <div class="alert alert-danger">{{$message}}</div>
            @endif
            <div class="card-body">
                <dl class="">
                    <dd class="h4 fw-bolder">{{$marca->nm_marca}}</dd>
                    <dd class="h5 fw-bolder">{{$marca->categoria()}}</dd>
                    <textarea class="form-control" disabled style="background-color: white; height: 160px;">{{empty($marca->ds_marca) ? 'Marca não contém detalhes' : $marca->ds_marca}}</textarea>
                </dl>
                <a href="/marcas"><button type="button" class="btn btn-primary">Voltar</button></a>
                <input class="btn btn-danger col-3" type="submit" value="Excluir">
            </div>
        </form>
    </div>
</div>
@endsection
