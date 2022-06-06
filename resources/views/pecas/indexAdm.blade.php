@extends('master')
@section('body')
    @php
    $paginas = collect([
        ["link"=>"/", "nm_pag" => "Dashboard"], 
        ["link"=>"/pecas", "nm_pag" => "Peças"],
    ])->collect();
    @endphp

<x-breadcrumb :paginas="$paginas" />

    <div class="card-display border-bottom-orange">
        <div
            class="rounded bg-primary-dark border-bottom-orange text-white p-2 mx-auto row col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="px-0 col-lg-6 col-md-8 col-sm-12 col-12 text-lg-start text-md-start text-sm-center text-center">
                <h2 class="col-12">
                    Administração de Peças
                </h2>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12 col-12 my-auto text-lg-end text-md-end text-sm-center text-center">
                <a href="/pecas/create">
                    <button class="btn btn-primary">Adicionar peça</button>
                </a>
            </div>
        </div>
        <div class="pt-3 table-responsive p-2">
            @if (sizeof($pecas) > 0)
                <table class="rounded table table-hover">
                    <thead class="bg-primary-dark text-white">
                        <tr>
                            <th class="m-0 text-center">Id</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Empresa</th>
                            <th>Categoria</th>
                            <th class="m-0 text-center">Valor</th>
                            <th class="m-0 text-center">Estoque</th>
                            <th class="m-0 text-center">Comandos</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($pecas as $x)
                            <tr>
                                <td class="m-0 text-center">{{ $x->id }}</td>
                                <td class="m-0">{{ $x->nm_peca }}</td>
                                <td class="m-0">{{ $x->nm_marca }}</td>
                                <td class="m-0">{{ $x->razao_social }}</td>
                                <td class="m-0">{{ $x->nm_tipo }}</td>
                                <td class="m-0 text-center">R$ {{ number_format($x->vl_peca, 2, ',') }}</td>
                                <td class="m-0 text-center">{{ $x->qt_estoque }}</td>
                                <td class="m-0 text-center">
                                    <a href="/pecas/{{ $x->id }}/edit">
                                        <button class="btn btn-outline-info">Editar</button>
                                    </a>
                                    <a href="/pecas/{{ $x->id }}">
                                        <button class="btn btn-outline-success">Visualizar</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center align-end">
                    {{ $pecas->onEachSide(5)->links() }}
                </div>
            @else
            <div class="p-2">
                <div class="card" style="">
                    <div class="row text-center mb-4">
                        <img class="col-md-3 col-12 m-3" src="{{URL::asset('icons/undraw_not_found_-60-pq.svg')}}" class="img-fluid" alt="" style="width: 21%">
                        <h1  class="col-md-auto col-12 my-auto">
                            Não contém dados.
                        </h1>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
