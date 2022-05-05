@extends('master')


@section('body')
<div class="card p-5 border-bottom-orange text-white">
    Em desenvolvimento
    <div>
        Dados do seu usuário: {{isset($dadosUsuario) ? $dadosUsuario : 'não está logado...'}}
    </div>
</div>
@endsection