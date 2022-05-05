@extends('master')
@section('body')
<div class="card border-bottom-orange p-2">
    <div class="mx-auto col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="px-0 col-lg-6 col-md-6 col-sm-12 col-12 text-lg-start text-md-start text-sm-center text-center">
            <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Adiministração de Usuários</h1>
        </div>
    </div>
<div class="pt-3 table-responsive">
    @if(sizeof($usuarios) > 0)
    <table class="rounded table">
        <thead class="bg-primary-dark text-white">
            <tr>
                <th class="m-0 text-center">Id</th>
                <th>Nome</th>
                <th class="m-0 text-center">Data de nascimento</th>
                <th class="m-0 text-center">E-Mail</th>
                <th class="m-0 text-center">CEP</th>
                <th class="m-0 text-center">Comandos</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($usuarios as $x)
            <tr>
                <td class="m-0 text-center">{{$x->id}}</td>
                <td class="m-0">{{$x->nm_usuario}}</td>
                <td class="m-0 text-center">{{$x->dt_nasc}}</td>
                <td class="m-0 text-center">{{$x->email}}</td>
                <td class="m-0 text-center">{{$x->cep}}</td>
                <td class="m-0 text-center">
                    <a href="usuarios/{{$x->id}}/edit">
                        <button class="btn btn-outline-info">Editar</button>
                    </a>
                    <a href="usuarios/{{$x->id}}">
                        <button class="btn btn-outline-success">Visualizar</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center align-end">
        {{ $usuarios->onEachSide(5)->links() }}
    </div>
    @else
    <div class="card" style="height: 25vh;">
        <h1 class="m-auto my-auto">
            Não contém dados
        </h1>
    </div>
    @endif
</div></div>

@endsection