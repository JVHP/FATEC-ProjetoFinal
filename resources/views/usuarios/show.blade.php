@extends('master')

@section("body")@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/usuarios", "nm_pag" => "Usuários"],
    ["link"=>"", "nm_pag" => "Visualizar Usuário"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="mx-auto col-4">
    <div class="card-display border-bottom-orange">
        <form action="/usuarios/{{$usuario->id}}" method="POST">
            @csrf
            @method('DELETE')
                <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12" >Visualizar Usuário</h2>
                <!-- <hr class="p-1 m-0 bg-primary col-xl-7 col-lg-9 col-md-11 col-sm-11" style="opacity: 100%; padding-top: 0"> -->
            <div class="card-body">
                <dl class="">
                    <dd class="h3 fw-bolder">{{$usuario->nm_usuario}}</dd>
                    <dd class="h5">Email: {{$usuario->email}}</dd>
                    <dd class="h5">Data de nascimento: {{date('d/m/Y', strtotime($usuario->dt_nasc))}}</dd>
                    <dd class="h5">CEP: {{$usuario->cep}}</dd>
                </dl>
                <a href="/usuarios"><button type="button" class="btn btn-primary">Voltar</button></a>
                <input class="btn btn-danger col-3" type="submit" value="Excluir">
            </div>
        </form>
    </div>
</div>
@endsection