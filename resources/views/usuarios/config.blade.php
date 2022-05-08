@extends('master')


@section('body')
<div class="card-display border-bottom-orange text-white">
    <h1 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12">Alteração Cadastral {Em desenvolvimento}</h1>
    <div class=" p-5">
        Dados do seu usuário: {{isset($dadosUsuario) ? $dadosUsuario : 'não está logado...'}}
    </div>
</div>
@endsection