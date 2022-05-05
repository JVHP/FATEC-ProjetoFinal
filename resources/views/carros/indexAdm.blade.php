@extends('master')

@section("body")
<div class="card-display border-bottom-orange p-2">
    <div class="mx-auto row col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="px-0 col-lg-6 col-md-6 col-sm-12 col-12 text-lg-start text-md-start text-sm-center text-center">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-10 col-md-10 col-sm-12 col-12">Adiministração de Carros</h1>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 my-auto text-lg-end text-md-end text-sm-center text-center">
            <a href="/carros/create">
                <button class="btn btn-primary">Adicionar carro</button>
            </a>
        </div>
    </div>
<div class="pt-3 table-responsive">
    @if(sizeof($carros) > 0)
    <table class="rounded table bg-white">
        <thead class="bg-primary-dark text-white">
            <tr>
                <th class="m-0 text-center">Id</th>
                <th>Nome</th>
                <th>Ano</th>
                <th>Categoria</th>
                <th class="m-0 text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($carros as $x)
            <tr>
                <td class="m-0 text-center">{{$x->id}}</td>
                <td class="m-0">{{$x->nm_carro}}</td>
                <td class="m-0">{{$x->ano}}</td>
                <td class="m-0">{{$x->tipoCarro()->first()->nm_tipo}}</td>
                <td class="m-0 text-center">
                    <a href="carros/{{$x->id}}/edit">
                        <button class="btn btn-outline-info">Editar</button>
                    </a>
                    <a href="carros/{{$x->id}}">
                        <button class="btn btn-outline-success">Visualizar</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center align-end">
        {{ $carros->onEachSide(5)->links() }}
    </div>
    @else
    <div class="card" style="height: 25vh;">
        <h1 class="m-auto my-auto">
            Não contém dados
        </h1>
    </div>
    @endif
</div>
</div>
@endsection