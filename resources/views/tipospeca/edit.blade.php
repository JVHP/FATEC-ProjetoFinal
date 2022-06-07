@extends('master')

@section('body')
@php
$paginas = collect([
    ["link"=>"/", "nm_pag" => "Dashboard"], 
    ["link"=>"/tipospeca", "nm_pag" => "Tipos de Peça"],
    ["link"=>"", "nm_pag" => "Editar Tipo de Peça"],
])->collect();
@endphp

<x-breadcrumb :paginas="$paginas" />
<div class="">
    <div class="card-display border-bottom-orange col-lg-5 col-md-7 col-sm-8 col-12 mx-auto">
        <h2 class="rounded bg-primary-dark border-bottom-orange text-white p-2 col-12" >Editar Tipo de Peça</h2>
        <div class="card-body">
            @if(isset($message))
                <div class="alert alert-danger">{{$message}}</div>
            @endif
            <form class="" action="/tipospeca/{{$tipo->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="p-2">                    
                    <div class="form-floating">
                        @if($errors->has('nm_tipo'))
                        <input aria-describedby="invalid-feedback" class="form-control is-invalid" type="text" name="nm_tipo" id="nm_tipo" placeholder="Nome Peça" value="{{(empty(old('nm_tipo'))) ? $tipo->nm_tipo : (old('nm_tipo'))}}">
                        <div class="invalid-feedback">
                            {{ $errors->first('nm_tipo') }}
                        </div>
                        @else
                        <input class="form-control" type="text" name="nm_tipo" id="nm_tipo" placeholder="Nome do Tipo de Carro" value="{{(empty(old('nm_tipo'))) ? $tipo->nm_tipo : (old('nm_tipo'))}}">
                        @endif
                        <label for="nm_tipo">Nome do Tipo de Peça</label>
                        <div class="form-check form-switch">
                            @if($tipo->ck_ativo == 1)
                            <input class="form-check-input" name="ck_ativo" type="checkbox" value="on" checked role="switch" id="flexSwitchCheck">
                            @else
                            <input class="form-check-input" name="ck_ativo" type="checkbox" value="" role="switch" id="flexSwitchCheck">
                            @endif
                            <label class="form-check-label" for="flexSwitchCheck">Ativo</label>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <input class="btn btn-success" type="submit" value="Salvar">
                    <a href="/tipospeca">
                        <button class="btn btn-danger" type="button">
                            Voltar
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection