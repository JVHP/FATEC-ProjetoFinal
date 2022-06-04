@extends('master')

@section('body')
    @php
    $paginas = collect([
        ['link' => '/', 'nm_pag' => 'Dashboard'],
        ['link' => '/empresas', 'nm_pag' => 'Empresas'], 
        ['link' => '', 'nm_pag' => 'Visualizar Empresa']
    ])->collect();
    @endphp

    <x-breadcrumb :paginas="$paginas" />

    <div class="col-12" style="height: 100vh;">
        <div class="card-display border-bottom-orange">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2">
                Visualizar Empresa
            </h1>
            <div class="">
                <div class="card-body d-flex justify-content-center">
                    <dl class="">
                        <dd class="h5">CNPJ: <p class="fw-bolder">{{ $empresa->cnpj_mascara }}</p></dd>
                        <dd class="h5">Razão Social: <p class="fw-bolder">{{ $empresa->razao_social }}</p></dd>
                        <dd class="h5 link">Link: <p class="fw-bolder"><a href="{{$empresa->gerarLink()}}">{{$empresa->gerarLink()}}</a></p></textarea>
                    </dl>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end p-3 mx-auto">
                    <a href="/empresas"><button type="button" class="btn btn-primary">Voltar</button></a>
                    <a href="/empresas/{{$empresa->id}}/edit"><button type="button" class="btn btn-info">Ir para Edição</button></a>
                </div>
            </div>
        </div>
    @endsection

    <script></script>
