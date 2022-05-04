@extends('master')

@section("body")
<div class="mx-auto col-4 pt-5">
    <div class="card">
        <form action="/usuarios/{{$usuario->id}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="card-title ps-2 pt-2 mb-0">
                <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-lg-8 col-md-8 col-sm-12 col-12" >Visualizar Usuário</h2>
                <!-- <hr class="p-1 m-0 bg-primary col-xl-7 col-lg-9 col-md-11 col-sm-11" style="opacity: 100%; padding-top: 0"> -->
            </div>
            <div class="card-body">
                <dl class="">
                    <dd class="h3 fw-bolder">{{$usuario->nm_usuario}}</dd>
                    <dd class="h5">Email: {{$usuario->email}}</dd>
                    <dd class="h5">Data de nascimento: {{$usuario->dt_nasc}}</dd>
                    <dd class="h5">CEP: {{$usuario->cep}}</dd>
                </dl>
                <a href="/usuarios"><button type="button" class="btn btn-primary">Voltar</button></a>
                <input class="btn btn-danger col-3" type="submit" value="Excluir">
            </div>
        </form>
    </div>
</div>
@endsection