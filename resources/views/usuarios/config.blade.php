@extends('master')


@section('body')
@php
$paginas = collect([
    ["link"=>"/loja/".session('empresa')->url_customizada, "nm_pag" => "Início"], 
    ["link"=>"", "nm_pag" => "Alteração Cadastral"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="card-display border-bottom-orange text-white">
    <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Alteração Cadastral {Em desenvolvimento}</h1>
    <div class=" p-5">
        Dados do seu usuário: {{isset($dadosUsuario) ? $dadosUsuario : 'não está logado...'}}
    </div>
</div>
@endsection